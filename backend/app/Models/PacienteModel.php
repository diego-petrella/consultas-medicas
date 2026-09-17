<?php

namespace App\Models;

use CodeIgniter\Model;

class PacienteModel extends Model
{
    protected $table            = 'pacientes';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['dni', 'nombre', 'apellido', 'fecha_nacimiento', 'telefono', 'obra_social_id', 'activo', 'created_at'];

    public function buscarPorDni(string $dni): ?array
    {
        return $this->where('dni', $dni)->where('activo', 1)->first();
    }

    public function obtenerConObraSocial(int $id): ?array
    {
        $this->select('pacientes.*, obras_sociales.nombre as obra_social_nombre');
        $this->join('obras_sociales', 'obras_sociales.id = pacientes.obra_social_id', 'left');
        $this->where('pacientes.id', $id);
        $this->where('pacientes.activo', 1);

        return $this->first();
    }

    public function listarTodos(): array
    {
        $this->select('pacientes.dni, pacientes.nombre, pacientes.apellido, pacientes.fecha_nacimiento, pacientes.telefono, obras_sociales.nombre as obra_social_nombre, pacientes.id');
        $this->join('obras_sociales', 'obras_sociales.id = pacientes.obra_social_id', 'left');
        $this->where('pacientes.activo', 1);
        $this->orderBy('pacientes.apellido', 'ASC');

        return $this->findAll();
    }
}
