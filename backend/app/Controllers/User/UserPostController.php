<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Services\User\UserFinderService;
use Exception;

class UserPostController extends BaseController
{
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

