<?php

namespace App\Controllers\Paciente;

use App\Controllers\BaseController;
use App\Services\Paciente\PacienteUpdaterService;

class PacientePutController extends BaseController
{
    public function put(int $id)
    {
        $data = $this->request->getJSON(true);

        $service = new PacienteUpdaterService();
        $service->actualizar($id, $data);

        return $this->response->setStatusCode(200)->setJSON(['id' => $id]);
    }
}
