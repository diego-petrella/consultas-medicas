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
    protected $allowedFields    = ['user_id', 'matricula', 'especialidad', 'telefono'];

    public function obtenerPorUserId(int $userId)
    {
        return $this->where('user_id', $userId)->first();
    }
}
