<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Services\User\UserDeleterService;

class UserDeleteController extends BaseController
{
    public function do(int $id)
    {
        $service = new UserDeleterService();
        $service->eliminar($id);

        return $this->response->setStatusCode(200)->setJSON(['id' => $id]);
    }
}
