<?php

namespace App\Services\Visita;

use App\Models\PacienteModel;
use Config\Database;
use Exception;

/**
 * Crea una visita, dando de alta o actualizando al paciente segun corresponda.
 *
 * Dentro de una unica transaccion: busca el paciente por DNI (lo actualiza si
 * ya existe, lo crea si no) y luego crea la visita vinculada a ese paciente.
 * Si algo falla, se hace rollback de toda la operacion.
 */
final class VisitaCreatorService
{
    private PacienteModel $pacienteModel;

    public function __construct()
    {
        $this->pacienteModel = new PacienteModel();
    }

    /**
     * @param array $data Requerido: dni, nombre, apellido, doctor_id, fecha.
     *                     Opcional: fecha_nacimiento, obra_social_id, estado.
     *
     * @throws Exception Si la transaccion falla.
     */
    public function crear(array $data): int
    {
        $db = Database::connect();
        $db->transStart();

        $paciente = $this->pacienteModel->buscarPorDni($data['dni']);

        if ($paciente) {
            $pacienteId = $paciente['id'];

            $this->pacienteModel->update($pacienteId, [
                'nombre'         => $data['nombre'],
                'apellido'       => $data['apellido'],
                'obra_social_id' => $data['obra_social_id'] ?? null,
            ]);
        } else {
            $pacienteId = $this->pacienteModel->insert([
                'dni'              => $data['dni'],
                'nombre'           => $data['nombre'],
                'apellido'         => $data['apellido'],
                'fecha_nacimiento' => $data['fecha_nacimiento'] ?? null,
                'obra_social_id'   => $data['obra_social_id'] ?? null,
                'created_at'       => date('Y-m-d H:i:s'),
            ]);
        }

        $db->table('visitas')->insert([
            'fecha'          => $data['fecha'],
            'paciente_id'    => $pacienteId,
            'doctor_id'      => $data['doctor_id'],
            'obra_social_id' => $data['obra_social_id'] ?? null,
            'estado'         => $data['estado'] ?? 1,
        ]);

        $visitaId = $db->insertID();

        $db->transComplete();

        if ($db->transStatus() === false) {
            throw new Exception('No se pudo crear la visita.');
        }

        return (int) $visitaId;
    }
}
