<?php

namespace App\Controllers\HistoriaClinica;

use App\Controllers\BaseController;
use App\Services\HistoriaClinica\HistoriaClinicaFinderService;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;

class HistoriaClinicaPdfController extends BaseController
{
    public function pdf(int $id): ResponseInterface
    {
        $service  = new HistoriaClinicaFinderService();
        $historia = $service->buscarPorId($id);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($this->buildHtml($historia));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $this->response
            ->setContentType('application/pdf')
            ->setBody($dompdf->output());
    }

    private function buildHtml(array $historia): string
    {
        $fecha = esc(date('d/m/Y H:i', strtotime($historia['fecha'])));
        $paciente = esc($historia['paciente_nombre'] . ' ' . $historia['paciente_apellido']);
        $dni = esc($historia['paciente_dni']);
        $doctor = esc($historia['doctor_nombre'] . ' ' . $historia['doctor_apellido']);
        $matricula = esc($historia['doctor_matricula']);
        $diagnostico = nl2br(esc($historia['diagnostico']));
        $tratamiento = nl2br(esc($historia['tratamiento']));
        $observaciones = nl2br(esc($historia['observaciones'] ?? ''));

        return <<<HTML
            <html>
            <head>
                <style>
                    body { font-family: sans-serif; font-size: 12px; }
                    h1 { font-size: 18px; }
                    .campo { margin-bottom: 10px; }
                    .campo strong { display: inline-block; width: 140px; }
                </style>
            </head>
            <body>
                <h1>Historia Clinica</h1>
                <div class="campo"><strong>Fecha:</strong> {$fecha}</div>
                <div class="campo"><strong>Paciente:</strong> {$paciente} (DNI {$dni})</div>
                <div class="campo"><strong>Doctor:</strong> {$doctor} (Matricula {$matricula})</div>
                <div class="campo"><strong>Diagnostico:</strong><br>{$diagnostico}</div>
                <div class="campo"><strong>Tratamiento:</strong><br>{$tratamiento}</div>
                <div class="campo"><strong>Observaciones:</strong><br>{$observaciones}</div>
            </body>
            </html>
            HTML;
    }
}
