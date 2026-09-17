<?php

namespace App\Services\Paciente;

use App\Models\PacienteModel;

final class PacienteDeleterService
{
    private PacienteModel $pacienteModel;
    private PacienteFinderService $pacienteFinderService;

    public function __construct()
    {
        $this->pacienteModel         = new PacienteModel();
        $this->pacienteFinderService = new PacienteFinderService();
    }

    public function eliminar(int $id): void
    {
        $this->pacienteFinderService->buscarPorId($id);
        $this->pacienteModel->update($id, ['activo' => 0]);
    }
}
