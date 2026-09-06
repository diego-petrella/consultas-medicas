<?php

namespace App\Controllers\Doctor;

use App\Controllers\BaseController;
use App\Services\Doctor\DoctorUpdaterService;

class DoctorPutController extends BaseController
{
    public function put(int $id)
    {
        $data = $this->request->getJSON(true);

        $service = new DoctorUpdaterService();
        $service->actualizar($id, $data);

        return $this->response->setStatusCode(200)->setJSON(['id' => $id]);
    }
}
