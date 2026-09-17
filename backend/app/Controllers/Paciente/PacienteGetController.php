<?php

namespace App\Controllers\Paciente;

use App\Controllers\BaseController;
use App\Models\PacienteModel;

class PacienteGetController extends BaseController
{
    public function index()
    {
        $pacienteModel = new PacienteModel();

        return $this->response->setStatusCode(200)->setJSON($pacienteModel->listarTodos());
    }
}
