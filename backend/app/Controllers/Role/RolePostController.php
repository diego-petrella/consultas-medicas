<?php

namespace App\Controllers\Role;

use App\Dto\Request\Role\RoleRequest;
use App\Services\Role\RoleCreatorService;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

final class RolePostController extends ResourceController
{
    private RoleCreatorService $roleCreatorService;

    public function __construct()
    {
        $this->roleCreatorService = new RoleCreatorService();
    }

    public function create(): ResponseInterface
    {
        $request  = $this->getRequest();
        $response = $this->roleCreatorService->create($request);

        return $this->response->setStatusCode(201)->setJSON($response);
    }

    private function getRequest(): RoleRequest
    {
        $body = $this->request->getJSON();

        return new RoleRequest(
            nombre: $body->nombre ?? '',
        );
    }
}
