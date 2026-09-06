<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoriaClinicaModel extends Model
{
    protected $table            = 'historias_clinicas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['paciente_id', 'doctor_id', 'fecha', 'diagnostico', 'tratamiento', 'observaciones'];

    public function obtenerPorPaciente(int $pacienteId): array
    {
        $this->select('historias_clinicas.*, users.nombre as doctor_nombre, users.apellido as doctor_apellido');
        $this->join('doctores', 'doctores.id = historias_clinicas.doctor_id');
        $this->join('users', 'users.id = doctores.user_id');
        $this->where('historias_clinicas.paciente_id', $pacienteId);
        $this->orderBy('historias_clinicas.fecha', 'DESC');

        return $this->findAll();
    }

    public function obtenerConDetalle(int $id): ?array
    {
        $this->select('historias_clinicas.*,
            pacientes.nombre as paciente_nombre,
            pacientes.apellido as paciente_apellido,
            pacientes.dni as paciente_dni,
            users.nombre as doctor_nombre,
            users.apellido as doctor_apellido,
            doctores.matricula as doctor_matricula'
        );
        $this->join('pacientes', 'pacientes.id = historias_clinicas.paciente_id');
        $this->join('doctores', 'doctores.id = historias_clinicas.doctor_id');
        $this->join('users', 'users.id = doctores.user_id');
        $this->where('historias_clinicas.id', $id);

        return $this->first();
    }
}
