<?php

namespace App\Services\Role;

use App\Converter\Role\RoleToRoleResponseConverter;
use App\Dto\Request\Role\RoleRequest;
use App\Dto\Response\Role\RoleResponse;
use App\Models\RoleModel;

final class RoleUpdaterService
{
    private RoleModel $roleModel;
    private RoleFinderService $roleFinderService;
    private RoleToRoleResponseConverter $converter;

    public function __construct()
    {
        $this->roleModel         = new RoleModel();
        $this->roleFinderService = new RoleFinderService();
        $this->converter         = new RoleToRoleResponseConverter();
    }

    public function update(RoleRequest $request, int $id): RoleResponse
    {
        $role = $this->roleFinderService->find($id);

        $role->update($request);

        $updatedRole = $this->roleModel->update($role);

        return $this->converter->convert($updatedRole);
    }
}
