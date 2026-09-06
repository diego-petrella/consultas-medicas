<?php

namespace App\Services\User;

use App\Models\UserModel;

final class UserCreatorService
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function crear(array $data): int
    {
        return $this->userModel->insert([
            'username'   => $data['username'],
            'password'   => password_hash($data['password'], PASSWORD_BCRYPT),
            'nombre'     => $data['nombre'],
            'apellido'   => $data['apellido'],
            'role_id'    => $data['role_id'],
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
