<?php

namespace App\Controllers\Role;

use App\Dto\Request\Role\RoleRequest;
use App\Services\Role\RoleUpdaterService;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

final class RolePutController extends ResourceController
{
    private RoleUpdaterService $roleUpdaterService;

    public function __construct()
    {
        $this->roleUpdaterService = new RoleUpdaterService();
    }

    public function put(int $id): ResponseInterface
    {
        $request  = $this->getRequest();
        $response = $this->roleUpdaterService->update($request, $id);

        return $this->response->setJSON($response);
    }

    private function getRequest(): RoleRequest
    {
        $body = $this->request->getJSON();

        return new RoleRequest(
            nombre: $body->nombre ?? '',
        );
    }
}
