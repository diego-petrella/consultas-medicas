<?php

namespace App\Services\User;

use App\Models\UserModel;

final class UserUpdaterService
{
    private UserModel $userModel;
    private UserFinderService $userFinderService;

    public function __construct()
    {
        $this->userModel         = new UserModel();
        $this->userFinderService = new UserFinderService();
    }

    public function actualizar(int $id, array $datos): void
    {
        $this->userFinderService->buscarPorId($id);

        $cambios = [
            'nombre'   => $datos['nombre'],
            'apellido' => $datos['apellido'],
            'role_id'  => $datos['role_id'],
        ];

        if (! empty($datos['password'])) {
            $cambios['password'] = password_hash($datos['password'], PASSWORD_BCRYPT);
        }

        $this->userModel->update($id, $cambios);
    }
}
