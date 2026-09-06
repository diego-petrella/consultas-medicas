<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Converter\User\UserToUserResponseConverter;
use App\Models\UserModel;

class UserGetController extends BaseController
{
    public function find()
    {
        $userModel = new UserModel();
        $converter = new UserToUserResponseConverter();

        $usuarios  = $userModel->listarTodos();
        $responses = [];

        foreach ($usuarios as $usuario) {
            $responses[] = $converter->convert($usuario);
        }

        return $this->response->setStatusCode(200)->setJSON($responses);
    }
}
