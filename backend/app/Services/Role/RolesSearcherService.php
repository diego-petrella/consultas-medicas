<?php

namespace App\Services\Role;

use App\Converter\Role\RoleToRoleResponseConverter;
use App\Dto\Request\Role\RoleFilterRequest;
use App\Models\RoleModel;

final class RolesSearcherService
{
    private RoleModel $roleModel;
    private RoleToRoleResponseConverter $converter;

    public function __construct()
    {
        $this->roleModel = new RoleModel();
        $this->converter = new RoleToRoleResponseConverter();
    }

    public function searchResponses(RoleFilterRequest $request): array
    {
        $entities  = $this->roleModel->search($request);
        $responses = [];

        foreach ($entities as $entity) {
            $responses[] = $this->converter->convert($entity);
        }

        return $responses;
    }
}
