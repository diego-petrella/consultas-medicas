<?php

namespace App\Services\Role;

use App\Models\RoleModel;

final class RoleService
{
    private RoleModel $roleModel;

    public function __construct()
    {
        $this->roleModel = new RoleModel();
    }

    public function listar(): array
    {
        return $this->roleModel->listarTodos();
    }

    public function existe(int $roleId): bool
    {
        return $this->roleModel->find($roleId) !== null;
    }
}
