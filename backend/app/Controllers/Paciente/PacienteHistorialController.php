<?php

namespace App\Controllers\Paciente;

use App\Controllers\BaseController;
use App\Models\HistoriaClinicaModel;
use App\Services\Paciente\PacienteFinderService;

class PacienteHistorialController extends BaseController
{
    public function historial(int $id)
    {
        $pacienteFinderService = new PacienteFinderService();
        $paciente              = $pacienteFinderService->buscarPorId($id);

        $historiaClinicaModel = new HistoriaClinicaModel();
        $historias            = $historiaClinicaModel->obtenerPorPaciente($id);

        return $this->response->setStatusCode(200)->setJSON([
            'paciente'  => $paciente,
            'historias' => $historias,
        ]);
    }
}
