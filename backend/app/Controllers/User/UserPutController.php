<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Services\Role\RoleService;
use App\Services\User\UserUpdaterService;

class UserPutController extends BaseController
{
    public function put(int $id)
    {
        $data = $this->request->getJSON(true);

        $requeridos = ['nombre', 'apellido', 'role_id'];
        $faltantes  = array_filter($requeridos, fn ($campo) => empty($data[$campo]));

        if (! empty($faltantes)) {
            return $this->response->setStatusCode(422)->setJSON([
                'error' => 'Faltan campos requeridos: ' . implode(', ', $faltantes),
            ]);
        }

        $roleService = new RoleService();
        if (! $roleService->existe((int) $data['role_id'])) {
            return $this->response->setStatusCode(422)->setJSON([
                'error' => 'role_id invalido',
            ]);
        }

        $service = new UserUpdaterService();
        $service->actualizar($id, $data);

        return $this->response->setStatusCode(200)->setJSON(['id' => $id]);
    }
}
