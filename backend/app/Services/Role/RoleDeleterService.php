<?php

namespace App\Services\Role;

use App\Models\RoleModel;

final class RoleDeleterService
{
    private RoleModel $roleModel;
    private RoleFinderService $roleFinderService;

    public function __construct()
    {
        $this->roleModel         = new RoleModel();
        $this->roleFinderService = new RoleFinderService();
    }

    public function delete(int $id): void
    {
        $role = $this->roleFinderService->find($id);
        $this->roleModel->delete($role->getId());
    }
}
