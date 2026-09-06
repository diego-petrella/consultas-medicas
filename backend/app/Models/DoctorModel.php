<?php

namespace App\Models;

use App\Converter\Doctor\PrimitiveToDoctorConverter;
use App\Converter\Doctor\PrimitiveToDoctorResponseConverter;
use App\Entity\Doctor\Doctor;
use CodeIgniter\Database\BaseConnection;
use Config\Database;

final class DoctorModel
{
    private BaseConnection $db;
    private PrimitiveToDoctorConverter $converter;
    private PrimitiveToDoctorResponseConverter $responseConverter;

    private const SELECT_CON_USUARIO = 'SELECT doctores.*, users.username, users.nombre, users.apellido
        FROM doctores
        JOIN users ON users.id = doctores.user_id ';

    public function __construct()
    {
        $this->db                = Database::connect();
        $this->converter         = new PrimitiveToDoctorConverter();
        $this->responseConverter = new PrimitiveToDoctorResponseConverter();
    }

    public function find(int $id): ?Doctor
    {
        $result    = $this->db->query('SELECT * FROM doctores WHERE id = ?', [$id]);
        $primitive = $result->getRow();

        if ($primitive === null) {
            return null;
        }

        return $this->converter->convert($primitive);
    }

    public function obtenerPorUserId(int $userId): ?array
    {
        $result = $this->db->query('SELECT * FROM doctores WHERE user_id = ?', [$userId]);

        return $result->getRowArray();
    }

    public function buscarPorMatricula(string $matricula): ?Doctor
    {
        $result    = $this->db->query('SELECT * FROM doctores WHERE matricula = ?', [$matricula]);
        $primitive = $result->getRow();

        if ($primitive === null) {
            return null;
        }

        return $this->converter->convert($primitive);
    }

    public function listarConUsuario(): array
    {
        $result     = $this->db->query(self::SELECT_CON_USUARIO . 'WHERE doctores.activo = 1 ORDER BY users.apellido ASC');
        $primitives = $result->getResult();

        $responses = [];
        foreach ($primitives as $primitive) {
            $responses[] = $this->responseConverter->convert($primitive);
        }

        return $responses;
    }

    public function listarParaDropdown(): array
    {
        return $this->listarConUsuario();
    }

    public function obtenerConUsuario(int $id)
    {
        $result    = $this->db->query(self::SELECT_CON_USUARIO . 'WHERE doctores.id = ?', [$id]);
        $primitive = $result->getRow();

        if ($primitive === null) {
            return null;
        }

        return $this->responseConverter->convert($primitive);
    }

    public function insert(array $data): int
    {
        $this->db->query(
            'INSERT INTO doctores (user_id, matricula, especialidad, telefono, created_at) VALUES (?, ?, ?, ?, ?)',
            [
                $data['user_id'],
                $data['matricula'] ?? null,
                $data['especialidad'] ?? null,
                $data['telefono'] ?? null,
                $data['created_at'] ?? date('Y-m-d H:i:s'),
            ]
        );

        return (int) $this->db->insertID();
    }

    public function update(Doctor $doctor): Doctor
    {
        $this->db->query(
            'UPDATE doctores SET especialidad = ?, telefono = ? WHERE id = ?',
            [$doctor->getEspecialidad(), $doctor->getTelefono(), $doctor->getId()]
        );

        return $doctor;
    }

    public function delete(int $id): void
    {
        $this->db->query('UPDATE doctores SET activo = 0 WHERE id = ?', [$id]);
    }
}
