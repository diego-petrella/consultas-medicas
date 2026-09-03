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
    protected $allowedFields    = ['dni', 'nombre', 'apellido', 'fecha_nacimiento', 'obra_social_id', 'created_at'];

    public function buscarPorDni(string $dni): ?array
    {
        return $this->where('dni', $dni)->first();
    }
}
