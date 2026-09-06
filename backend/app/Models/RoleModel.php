<?php

namespace App\Models;

use App\Converter\Role\PrimitiveToRoleConverter;
use App\Dto\Request\Role\RoleFilterRequest;
use App\Entity\Role\Role;
use CodeIgniter\Database\BaseConnection;
use Config\Database;

final class RoleModel
{
    private BaseConnection $db;
    private PrimitiveToRoleConverter $converter;

    public function __construct()
    {
        $this->db        = Database::connect();
        $this->converter = new PrimitiveToRoleConverter();
    }

    public function find(int $id): ?Role
    {
        $result    = $this->db->query('SELECT * FROM roles WHERE id = ?', [$id]);
        $primitive = $result->getRow();

        if (is_null($primitive)) {
            return null;
        }

        return $this->converter->convert($primitive);
    }

    public function search(RoleFilterRequest $request): array
    {
        $parameters = [];

        $query = 'SELECT * FROM roles WHERE 1 = 1 ';

        if ($request->hasNombre()) {
            $query .= 'AND nombre LIKE ? ';
            $parameters[] = '%' . $request->getNombre() . '%';
        }

        $query .= 'ORDER BY nombre ASC ';
        $query .= 'LIMIT ?, ? ';
        $parameters[] = $request->getPagination()->getOffset();
        $parameters[] = $request->getPagination()->getLimit();

        $result     = $this->db->query($query, $parameters);
        $primitives = $result->getResult();

        $entities = [];
        foreach ($primitives as $primitive) {
            $entities[] = $this->converter->convert($primitive);
        }

        return $entities;
    }

    public function insert(Role $role): Role
    {
        $this->db->query(
            'INSERT INTO roles (nombre) VALUES (?)',
            [$role->getNombre()]
        );

        return $this->find($this->db->insertID());
    }

    public function update(Role $role): Role
    {
        $this->db->query(
            'UPDATE roles SET nombre = ? WHERE id = ?',
            [$role->getNombre(), $role->getId()]
        );

        return $role;
    }

    public function delete(int $id): void
    {
        $this->db->query('DELETE FROM roles WHERE id = ?', [$id]);
    }
}
