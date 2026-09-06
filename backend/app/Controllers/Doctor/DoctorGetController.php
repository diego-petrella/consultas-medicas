<?php

namespace App\Controllers\Doctor;

use App\Controllers\BaseController;
use App\Models\DoctorModel;

class DoctorGetController extends BaseController
{
    public function index()
    {
        $doctorModel = new DoctorModel();

        return $this->response->setStatusCode(200)->setJSON($doctorModel->listarConUsuario());
    }
}
