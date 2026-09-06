<?php

namespace App\Controllers\Doctor;

use App\Controllers\BaseController;
use App\Models\DoctorModel;

class DoctorActivosController extends BaseController
{
    public function activos()
    {
        $doctorModel = new DoctorModel();

        return $this->response->setStatusCode(200)->setJSON($doctorModel->listarParaDropdown());
    }
}
