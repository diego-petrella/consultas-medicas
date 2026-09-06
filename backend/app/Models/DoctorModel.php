<?php

namespace App\Models;

use CodeIgniter\Model;

class DoctorModel extends Model
{
    protected $table            = 'doctores';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'matricula', 'especialidad', 'telefono', 'activo', 'created_at'];

    public function obtenerPorUserId(int $userId)
    {
        return $this->where('user_id', $userId)->first();
    }

    public function buscarPorMatricula(string $matricula): ?array
    {
        return $this->where('matricula', $matricula)->first();
    }

    public function listarConUsuario(): array
    {
        $this->select('doctores.*, users.username, users.nombre, users.apellido');
        $this->join('users', 'users.id = doctores.user_id');
        $this->where('doctores.activo', 1);
        $this->orderBy('users.apellido', 'ASC');

        return $this->findAll();
    }

    public function listarParaDropdown(): array
    {
        $this->select('doctores.id, doctores.matricula, users.nombre, users.apellido');
        $this->join('users', 'users.id = doctores.user_id');
        $this->where('doctores.activo', 1);
        $this->orderBy('users.apellido', 'ASC');

        return $this->findAll();
    }

    public function obtenerConUsuario(int $id): ?array
    {
        $this->select('doctores.*, users.username, users.nombre, users.apellido');
        $this->join('users', 'users.id = doctores.user_id');
        $this->where('doctores.id', $id);

        return $this->first();
    }
}
