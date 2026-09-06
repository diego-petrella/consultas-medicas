<?php

namespace App\Models;

use App\Entity\User\User;
use App\Converter\User\PrimitiveToUserConverter;
use CodeIgniter\Database\BaseConnection;
use Config\Database;

final class UserModel
{
    private BaseConnection $database;
    private PrimitiveToUserConverter $converter;

    private const SELECT_CAMPOS = 'U.id, U.username, U.password, U.nombre, U.apellido, U.role_id, U.activo, U.created_at';

    public function __construct()
    {
        $this->database = Database::connect();
        $this->converter = new PrimitiveToUserConverter();
    }

    public function buscarPorUsername(string $username): ?User
    {
        $query = 'SELECT ' . self::SELECT_CAMPOS . '
                  FROM users U
                  WHERE U.username = ?';

        $result = $this->database->query($query, [$username]);
        $primitive = $result->getRow();

        if (empty($primitive)) {
            return null;
        }

        return $this->converter->convert($primitive);
    }

    public function find(int $id): ?User
    {
        $query = 'SELECT ' . self::SELECT_CAMPOS . '
                  FROM users U
                  WHERE U.id = ?';

        $result = $this->database->query($query, [$id]);
        $primitive = $result->getRow();

        if (empty($primitive)) {
            return null;
        }

        return $this->converter->convert($primitive);
    }

    public function listarTodos(): array
    {
        $query = 'SELECT ' . self::SELECT_CAMPOS . '
                  FROM users U
                  WHERE U.activo = 1
                  ORDER BY U.apellido ASC';

        $result = $this->database->query($query);
        $primitives = $result->getResult();

        $entities = [];
        foreach ($primitives as $primitive) {
            $entities[] = $this->converter->convert($primitive);
        }

        return $entities;
    }

    public function insert(array $data): int
    {
        $this->database->table('users')->insert($data);

        return (int) $this->database->insertID();
    }

    public function update(int $id, array $data): void
    {
        $this->database->table('users')->where('id', $id)->update($data);
    }
}
