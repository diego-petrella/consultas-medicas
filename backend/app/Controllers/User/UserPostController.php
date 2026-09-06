<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Services\Role\RoleService;
use App\Services\User\UserCreatorService;
use App\Services\User\UserFinderService;
use Exception;

class UserPostController extends BaseController
{
    public function create()
    {
        $data = $this->request->getJSON(true);

        $requeridos = ['username', 'password', 'nombre', 'apellido', 'role_id'];
        $faltantes  = array_filter($requeridos, fn ($campo) => empty($data[$campo]));

        if (! empty($faltantes)) {
            return $this->response->setStatusCode(422)->setJSON([
                'error' => 'Faltan campos requeridos: ' . implode(', ', $faltantes),
            ]);
        }

        $userModel = new UserModel();
        if ($userModel->buscarPorUsername($data['username']) !== null) {
            return $this->response->setStatusCode(409)->setJSON([
                'error' => 'Ya existe un usuario con ese username',
            ]);
        }

        $roleService = new RoleService();
        if (! $roleService->existe((int) $data['role_id'])) {
            return $this->response->setStatusCode(422)->setJSON([
                'error' => 'role_id invalido',
            ]);
        }

        $service = new UserCreatorService();
        $id      = $service->crear($data);

        return $this->response->setStatusCode(201)->setJSON(['id' => $id]);
    }

    public function login()
    {
        $data = $this->request->getJSON(true);

        $username = $data['username'] ?? null;
        $password = $data['password'] ?? null;

        if (!$username || !$password) {
            return $this->response->setStatusCode(422)->setJSON([
                'error' => 'Faltan campos requeridos: username y password',
            ]);
        }

        try {
            $service = new UserFinderService();
            $usuario = $service->validarCredenciales($username, $password);
        } catch (Exception $e) {
            return $this->response->setStatusCode(401)->setJSON([
                'error' => 'Credenciales inválidas',
            ]);
        }

        session()->set('usuario', $usuario);

        return $this->response->setStatusCode(200)->setJSON($usuario);
    }
}

