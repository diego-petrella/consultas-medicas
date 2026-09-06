<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitaModel extends Model
{
    protected $table            = 'visitas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['fecha', 'paciente_id', 'doctor_id', 'obra_social_id', 'estado'];

    private function conDetalle()
    {
        $this->select('visitas.*,
            pacientes.dni as paciente_dni,
            pacientes.nombre as paciente_nombre,
            pacientes.apellido as paciente_apellido,
            users.nombre as doctor_nombre,
            users.apellido as doctor_apellido,
            obras_sociales.nombre as obra_social_nombre'
        );
        $this->join('pacientes', 'pacientes.id = visitas.paciente_id');
        $this->join('doctores', 'doctores.id = visitas.doctor_id');
        $this->join('users', 'users.id = doctores.user_id');
        $this->join('obras_sociales', 'obras_sociales.id = visitas.obra_social_id', 'left');

        return $this;
    }

    public function listarConFiltros(array $filtros): array
    {
        $this->conDetalle();
        $this->where('visitas.estado', 1);

        if (! empty($filtros['dni'])) {
            $this->like('pacientes.dni', $filtros['dni']);
        }

        if (! empty($filtros['fecha'])) {
            $this->where('DATE(visitas.fecha)', $filtros['fecha']);
        }

        if (! empty($filtros['obra_social_id'])) {
            $this->where('visitas.obra_social_id', $filtros['obra_social_id']);
        }

        $this->orderBy('visitas.fecha', 'DESC');

        return $this->findAll();
    }

    public function obtenerConDetalle(int $id): ?array
    {
        $this->conDetalle();
        $this->where('visitas.id', $id);

        return $this->first();
    }
}
