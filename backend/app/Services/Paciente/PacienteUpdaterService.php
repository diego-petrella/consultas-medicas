<?php

namespace App\Services\Paciente;

use App\Exception\Paciente\PacienteNotFoundException;
use App\Models\PacienteModel;

final class PacienteUpdaterService
{
    private PacienteModel $pacienteModel;

    public function __construct()
    {
        $this->pacienteModel = new PacienteModel();
    }

    public function actualizar(int $id, array $datos): void
    {
        if ($this->pacienteModel->find($id) === null) {
            throw new PacienteNotFoundException($id);
        }

        $this->pacienteModel->update($id, [
            'nombre'           => $datos['nombre'],
            'apellido'         => $datos['apellido'],
            'fecha_nacimiento' => $datos['fecha_nacimiento'] ?? null,
            'telefono'         => $datos['telefono'] ?? null,
            'obra_social_id'   => $datos['obra_social_id'],
        ]);
    }
}
