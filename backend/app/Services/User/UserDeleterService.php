<?php

namespace App\Services\User;

use App\Models\UserModel;

final class UserDeleterService
{
    private UserModel $userModel;
    private UserFinderService $userFinderService;

    public function __construct()
    {
        $this->userModel         = new UserModel();
        $this->userFinderService = new UserFinderService();
    }

    public function eliminar(int $id): void
    {
        $this->userFinderService->buscarPorId($id);
        $this->userModel->update($id, ['activo' => 0]);
    }
}
