<?php

namespace App\Services\Paciente;

use App\Exception\Paciente\PacienteDniYaExisteException;
use App\Models\PacienteModel;

final class PacienteCreatorService
{
    private PacienteModel $pacienteModel;

    public function __construct()
    {
        $this->pacienteModel = new PacienteModel();
    }

    public function crear(array $datos): int
    {
        if ($this->pacienteModel->buscarPorDni($datos['dni']) !== null) {
            throw new PacienteDniYaExisteException($datos['dni']);
        }

        return $this->pacienteModel->insert([
            'dni'              => $datos['dni'],
            'nombre'           => $datos['nombre'],
            'apellido'         => $datos['apellido'],
            'fecha_nacimiento' => $datos['fecha_nacimiento'] ?? null,
            'telefono'         => $datos['telefono'] ?? null,
            'obra_social_id'   => $datos['obra_social_id'],
            'created_at'       => date('Y-m-d H:i:s'),
        ]);
    }
}
