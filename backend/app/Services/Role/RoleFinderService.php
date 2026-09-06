<?php

namespace App\Services\Role;

use App\Converter\Role\RoleToRoleResponseConverter;
use App\Dto\Response\Role\RoleResponse;
use App\Entity\Role\Role;
use App\Exception\Role\RoleNotFoundException;
use App\Models\RoleModel;

final class RoleFinderService
{
    private RoleModel $roleModel;
    private RoleToRoleResponseConverter $converter;

    public function __construct()
    {
        $this->roleModel = new RoleModel();
        $this->converter = new RoleToRoleResponseConverter();
    }

    public function find(int $id): Role
    {
        $role = $this->roleModel->find($id);

        if (empty($role)) {
            throw new RoleNotFoundException($id);
        }

        return $role;
    }

    public function findResponse(int $id): RoleResponse
    {
        return $this->converter->convert($this->find($id));
    }
}
