<?php

namespace App\Services\Paciente;

use App\Exception\Paciente\PacienteNotFoundException;
use App\Models\PacienteModel;

final class PacienteFinderService
{
    private PacienteModel $pacienteModel;

    public function __construct()
    {
        $this->pacienteModel = new PacienteModel();
    }

    public function buscarPorId(int $id): array
    {
        $paciente = $this->pacienteModel->obtenerConObraSocial($id);

        if ($paciente === null) {
            throw new PacienteNotFoundException($id);
        }

        return $paciente;
    }
}
