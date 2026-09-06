<?php

namespace App\Controllers\Paciente;

use App\Controllers\BaseController;
use App\Services\Paciente\PacienteCreatorService;

class PacientePostController extends BaseController
{
    public function create()
    {
        $data = $this->request->getJSON(true);

        if (empty($data['dni']) || empty($data['nombre']) || empty($data['apellido']) || empty($data['obra_social_id'])) {
            return $this->response->setStatusCode(422)->setJSON([
                'error' => 'Faltan campos requeridos: dni, nombre, apellido y obra_social_id',
            ]);
        }

        $service = new PacienteCreatorService();
        $id      = $service->crear($data);

        return $this->response->setStatusCode(201)->setJSON(['id' => $id]);
    }
}
