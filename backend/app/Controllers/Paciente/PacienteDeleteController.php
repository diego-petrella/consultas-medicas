<?php

namespace App\Controllers\Paciente;

use App\Controllers\BaseController;
use App\Services\Paciente\PacienteDeleterService;

class PacienteDeleteController extends BaseController
{
    public function do(int $id)
    {
        $service = new PacienteDeleterService();
        $service->eliminar($id);

        return $this->response->setStatusCode(200)->setJSON(['id' => $id]);
    }
}
