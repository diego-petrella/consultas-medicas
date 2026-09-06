<?php

namespace App\Controllers\Role;

use App\Dto\Request\PaginationRequest;
use App\Dto\Request\Role\RoleFilterRequest;
use App\Services\Role\RolesSearcherService;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

final class RolesGetController extends ResourceController
{
    private RolesSearcherService $rolesSearcherService;

    public function __construct()
    {
        $this->rolesSearcherService = new RolesSearcherService();
    }

    public function search(): ResponseInterface
    {
        $params  = $this->request->getGet();
        $request = new RoleFilterRequest(
            nombre: $params['nombre'] ?? null,
            pagination: new PaginationRequest(
                page: (int) ($params['page'] ?? 1),
                size: (int) ($params['size'] ?? 10),
            ),
        );

        return $this->response->setJSON(
            $this->rolesSearcherService->searchResponses($request)
        );
    }
}
