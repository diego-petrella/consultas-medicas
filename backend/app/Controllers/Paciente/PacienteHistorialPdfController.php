<?php

namespace App\Controllers\Paciente;

use App\Controllers\BaseController;
use App\Models\HistoriaClinicaModel;
use App\Services\Paciente\PacienteFinderService;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;

class PacienteHistorialPdfController extends BaseController
{
    public function pdf(int $id): ResponseInterface
    {
        $pacienteFinderService = new PacienteFinderService();
        $paciente              = $pacienteFinderService->buscarPorId($id);

        $historiaClinicaModel = new HistoriaClinicaModel();
        $historias            = $historiaClinicaModel->obtenerPorPaciente($id);
        $historias            = array_reverse($historias);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($this->buildHtml($paciente, $historias));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $this->response
            ->setContentType('application/pdf')
            ->setBody($dompdf->output());
    }

    private function buildHtml(array $paciente, array $historias): string
    {
        $nombre        = esc($paciente['nombre'] . ' ' . $paciente['apellido']);
        $dni           = esc($paciente['dni']);
        $obraSocial    = esc($paciente['obra_social_nombre'] ?? 'Sin obra social');
        $fechaNac      = !empty($paciente['fecha_nacimiento'])
            ? esc(date('d/m/Y', strtotime($paciente['fecha_nacimiento'])))
            : 'Sin dato';

        $historiasHtml = '';
        foreach ($historias as $historia) {
            $fecha         = esc(date('d/m/Y H:i', strtotime($historia['fecha'])));
            $doctor        = esc($historia['doctor_nombre'] . ' ' . $historia['doctor_apellido']);
            $diagnostico   = nl2br(esc($historia['diagnostico']));
            $tratamiento   = nl2br(esc($historia['tratamiento']));
            $observaciones = nl2br(esc($historia['observaciones'] ?? ''));

            $historiasHtml .= <<<HTML
                <div class="historia">
                    <div class="campo"><strong>Fecha:</strong> {$fecha}</div>
                    <div class="campo"><strong>Doctor:</strong> {$doctor}</div>
                    <div class="campo"><strong>Diagnostico:</strong><br>{$diagnostico}</div>
                    <div class="campo"><strong>Tratamiento:</strong><br>{$tratamiento}</div>
                    <div class="campo"><strong>Observaciones:</strong><br>{$observaciones}</div>
                </div>
                HTML;
        }

        if ($historiasHtml === '') {
            $historiasHtml = '<p>Este paciente no tiene consultas registradas.</p>';
        }

        return <<<HTML
            <html>
            <head>
                <style>
                    body { font-family: sans-serif; font-size: 12px; }
                    h1 { font-size: 18px; }
                    h2 { font-size: 15px; margin-top: 24px; border-bottom: 1px solid #999; padding-bottom: 4px; }
                    .campo { margin-bottom: 10px; }
                    .campo strong { display: inline-block; width: 140px; }
                    .historia { margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px dashed #ccc; }
                </style>
            </head>
            <body>
                <h1>Historial Clinico Completo</h1>
                <div class="campo"><strong>Paciente:</strong> {$nombre} (DNI {$dni})</div>
                <div class="campo"><strong>Fecha de nacimiento:</strong> {$fechaNac}</div>
                <div class="campo"><strong>Obra Social:</strong> {$obraSocial}</div>

                <h2>Consultas</h2>
                {$historiasHtml}
            </body>
            </html>
            HTML;
    }
}
