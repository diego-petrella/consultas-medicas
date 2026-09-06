<?php

namespace App\Controllers\Doctor;

use App\Controllers\BaseController;
use App\Services\Doctor\DoctorDeleterService;

class DoctorDeleteController extends BaseController
{
    public function delete(int $id)
    {
        $service = new DoctorDeleterService();
        $service->eliminar($id);

        return $this->response->setStatusCode(200)->setJSON(['id' => $id]);
    }
}
