<?php

namespace App\Models;

use App\Entity\Visita\Visita;
use App\Converter\Visita\PrimitiveToVisitaConverter;
use CodeIgniter\Database\BaseConnection;
use Config\Database;

class VisitaModel
{
    private BaseConnection $database;
    private PrimitiveToVisitaConverter $converter;

    public function __construct()
    {
        $this->database = Database::connect();
        $this->converter = new PrimitiveToVisitaConverter();
    }

    public function listarConFiltros(array $filtros = []): array
    {
        $builder = $this->database->table('visitas');
        
        $builder->select('visitas.*, 
            pacientes.nombre as paciente_nombre, 
            pacientes.apellido as paciente_apellido, 
            pacientes.dni as paciente_dni, 
            users.nombre as doctor_nombre, 
            users.apellido as doctor_apellido, 
            doctores.matricula as doctor_matricula, 
            obras_sociales.nombre as obra_social_nombre'
        );
        
        $builder->join('pacientes', 'pacientes.id = visitas.paciente_id');
        $builder->join('doctores', 'doctores.id = visitas.doctor_id');
        $builder->join('users', 'users.id = doctores.user_id');
        $builder->join('obras_sociales', 'obras_sociales.id = visitas.obra_social_id', 'left');

        // Filtro por defecto
        $builder->where('visitas.estado', 1);

        // Filtros opcionales
        if (!empty($filtros['dni'])) {
            $builder->like('pacientes.dni', $filtros['dni']);
        }

        if (!empty($filtros['fecha'])) {
            $builder->where('DATE(visitas.fecha)', $filtros['fecha']);
        }

        if (!empty($filtros['obra_social_id'])) {
            $builder->where('visitas.obra_social_id', $filtros['obra_social_id']);
        }

        $builder->orderBy('visitas.fecha', 'DESC');

        $query = $builder->get();
        $results = $query->getResult();
        
        $visitas = [];
        foreach ($results as $row) {
            $visitas[] = $this->converter->convert($row);
        }

        return $visitas;
    }
}
