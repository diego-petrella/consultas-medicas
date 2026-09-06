<?php

namespace App\Services\Visita;

use App\Models\PacienteModel;
use App\Models\VisitaModel;
use Config\Database;
use Exception;

final class VisitaCreatorService
{
    private VisitaModel $visitaModel;
    private PacienteModel $pacienteModel;

    public function __construct()
    {
        $this->visitaModel   = new VisitaModel();
        $this->pacienteModel = new PacienteModel();
    }

    public function crear(array $data): int
    {
        $db = Database::connect();
        $db->transStart();

        $paciente = $this->pacienteModel->buscarPorDni($data['dni']);

        if ($paciente !== null) {
            $pacienteId = $paciente['id'];
            $this->pacienteModel->update($pacienteId, [
                'nombre'         => $data['nombre'],
                'apellido'       => $data['apellido'],
                'obra_social_id' => $data['obra_social_id'] ?? $paciente['obra_social_id'],
            ]);
        } else {
            $pacienteId = $this->pacienteModel->insert([
                'dni'            => $data['dni'],
                'nombre'         => $data['nombre'],
                'apellido'       => $data['apellido'],
                'obra_social_id' => $data['obra_social_id'] ?? null,
                'created_at'     => date('Y-m-d H:i:s'),
            ]);
        }

        $visitaId = $this->visitaModel->insert([
            'fecha'          => $data['fecha'],
            'paciente_id'    => $pacienteId,
            'doctor_id'      => $data['doctor_id'],
            'obra_social_id' => $data['obra_social_id'] ?? null,
            'estado'         => 1,
        ]);

        $db->transComplete();

        if ($db->transStatus() === false) {
            throw new Exception('No se pudo crear la visita.');
        }

        return (int) $visitaId;
    }
}
