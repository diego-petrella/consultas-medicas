<?php

namespace App\Models;

use App\Converter\Visita\PrimitiveToVisitaConverter;
use App\Converter\Visita\PrimitiveToVisitaResponseConverter;
use App\Dto\Response\Visita\VisitaResponse;
use App\Entity\Visita\Visita;
use CodeIgniter\Database\BaseConnection;
use Config\Database;

final class VisitaModel
{
    private BaseConnection $db;
    private PrimitiveToVisitaConverter $converter;
    private PrimitiveToVisitaResponseConverter $responseConverter;

    private const SELECT_CON_DETALLE = "SELECT visitas.*,
            pacientes.dni as paciente_dni,
            pacientes.nombre as paciente_nombre,
            pacientes.apellido as paciente_apellido,
            users.nombre as doctor_nombre,
            users.apellido as doctor_apellido,
            obras_sociales.nombre as obra_social_nombre
        FROM visitas
        JOIN pacientes ON pacientes.id = visitas.paciente_id
        JOIN doctores ON doctores.id = visitas.doctor_id
        JOIN users ON users.id = doctores.user_id
        LEFT JOIN obras_sociales ON obras_sociales.id = visitas.obra_social_id ";

    public function __construct()
    {
        $this->db                = Database::connect();
        $this->converter         = new PrimitiveToVisitaConverter();
        $this->responseConverter = new PrimitiveToVisitaResponseConverter();
    }

    public function find(int $id): ?Visita
    {
        $result    = $this->db->query('SELECT * FROM visitas WHERE id = ?', [$id]);
        $primitive = $result->getRow();

        if ($primitive === null) {
            return null;
        }

        return $this->converter->convert($primitive);
    }

    public function buscarConDetalle(int $id): ?VisitaResponse
    {
        $result    = $this->db->query(self::SELECT_CON_DETALLE . 'WHERE visitas.id = ?', [$id]);
        $primitive = $result->getRow();

        if ($primitive === null) {
            return null;
        }

        return $this->responseConverter->convert($primitive);
    }

    public function listarConFiltros(array $filtros): array
    {
        $parameters = [];
        $query      = self::SELECT_CON_DETALLE . 'WHERE visitas.estado = 1 ';

        if (! empty($filtros['dni'])) {
            $query .= 'AND pacientes.dni LIKE ? ';
            $parameters[] = '%' . $filtros['dni'] . '%';
        }

        if (! empty($filtros['fecha'])) {
            $query .= 'AND DATE(visitas.fecha) = ? ';
            $parameters[] = $filtros['fecha'];
        }

        if (! empty($filtros['obra_social_id'])) {
            $query .= 'AND visitas.obra_social_id = ? ';
            $parameters[] = $filtros['obra_social_id'];
        }

        $query .= 'ORDER BY visitas.fecha DESC';

        $result     = $this->db->query($query, $parameters);
        $primitives = $result->getResult();

        $responses = [];
        foreach ($primitives as $primitive) {
            $responses[] = $this->responseConverter->convert($primitive);
        }

        return $responses;
    }

    public function insert(Visita $visita): Visita
    {
        $this->db->query(
            'INSERT INTO visitas (fecha, paciente_id, doctor_id, obra_social_id, estado) VALUES (?, ?, ?, ?, ?)',
            [
                $visita->getFecha(),
                $visita->getPacienteId(),
                $visita->getDoctorId(),
                $visita->getObraSocialId(),
                $visita->getEstado(),
            ]
        );

        return $this->find($this->db->insertID());
    }

    public function update(Visita $visita): Visita
    {
        $this->db->query(
            'UPDATE visitas SET fecha = ?, doctor_id = ?, obra_social_id = ? WHERE id = ?',
            [
                $visita->getFecha(),
                $visita->getDoctorId(),
                $visita->getObraSocialId(),
                $visita->getId(),
            ]
        );

        return $visita;
    }

    public function delete(int $id): void
    {
        $this->db->query('UPDATE visitas SET estado = 0 WHERE id = ?', [$id]);
    }
}
