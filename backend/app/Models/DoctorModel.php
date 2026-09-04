<?php

namespace App\Models;

use App\Entity\Doctor\Doctor;
use App\Converter\Doctor\PrimitiveToDoctorConverter;
use CodeIgniter\Database\BaseConnection;
use Config\Database;

class DoctorModel
{
    private BaseConnection $database;
    private PrimitiveToDoctorConverter $converter;

    public function __construct()
    {
        $this->database = Database::connect();
        $this->converter = new PrimitiveToDoctorConverter();
    }

    public function existeMatricula(string $matricula, int $exceptoId = 0): bool
    {
        $builder = $this->database->table('doctores');
        $builder->where('matricula', $matricula);
        
        if ($exceptoId > 0) {
            $builder->where('id !=', $exceptoId);
        }
        
        return $builder->countAllResults() > 0;
    }

    public function listarConUsuario(): array
    {
        $builder = $this->database->table('doctores');
        $builder->select('doctores.*, users.nombre, users.apellido, users.username');
        $builder->join('users', 'users.id = doctores.user_id');
        
        $query = $builder->get();
        $results = $query->getResult();
        
        $doctores = [];
        foreach ($results as $row) {
            $doctores[] = $this->converter->convert($row);
        }
        
        return $doctores;
    }

    public function listarParaDropdown(): array
    {
        $builder = $this->database->table('doctores');
        $builder->select('doctores.id, users.nombre, users.apellido');
        $builder->join('users', 'users.id = doctores.user_id');
        $builder->orderBy('users.apellido', 'ASC');
        $builder->orderBy('users.nombre', 'ASC');
        
        $query = $builder->get();
        
        // Para el dropdown simplemente devolvemos el arreglo resultante
        // ya que solo necesitamos estos 3 campos específicos y no la entidad completa
        return $query->getResultArray();
    }

    public function obtenerPorUserId(int $userId): ?Doctor
    {
        $builder = $this->database->table('doctores');
        $builder->where('user_id', $userId);
        
        $query = $builder->get();
        $row = $query->getRow();
        
        if (empty($row)) {
            return null;
        }
        
        return $this->converter->convert($row);
    }
}
