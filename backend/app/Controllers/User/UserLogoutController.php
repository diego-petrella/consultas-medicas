<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class UserLogoutController extends BaseController
{
    public function logout()
    {
        session()->destroy();

        return $this->response->setStatusCode(200)->setJSON([
            'message' => 'Sesión finalizada correctamente',
        ]);
    }
}