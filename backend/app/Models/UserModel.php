<?php

namespace App\Models;

use App\Entity\Users\User;
use App\Entity\Users\PrimitiveToUserConverter;
use CodeIgniter\Database\BaseConnection;
use Config\Database;

final class UserModel
{
    private BaseConnection $database;
    private PrimitiveToUserConverter $converter;

    public function __construct()
    {
        $this->database = Database::connect();
        $this->converter = new PrimitiveToUserConverter();
    }

    public function buscarPorUsername(string $username): ?User
    {
        $query = "SELECT U.id, U.username, U.password, U.nombre, U.apellido, U.role_id, U.created_at
                  FROM users U
                  WHERE U.username = ?";

        $result = $this->database->query($query, [$username]);
        $primitive = $result->getRow();

        if (empty($primitive)) {
            return null;
        }

        return $this->converter->convert($primitive);
    }
}
