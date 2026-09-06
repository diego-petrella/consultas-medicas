<?php

namespace App\Services\Role;

use App\Converter\Role\RoleToRoleResponseConverter;
use App\Dto\Request\Role\RoleRequest;
use App\Dto\Response\Role\RoleResponse;
use App\Entity\Role\Role;
use App\Models\RoleModel;

final class RoleCreatorService
{
    private RoleModel $roleModel;
    private RoleToRoleResponseConverter $converter;

    public function __construct()
    {
        $this->roleModel = new RoleModel();
        $this->converter = new RoleToRoleResponseConverter();
    }

    public function create(RoleRequest $request): RoleResponse
    {
        $role    = Role::convertFromRequest($request);
        $newRole = $this->roleModel->insert($role);

        return $this->converter->convert($newRole);
    }
}
