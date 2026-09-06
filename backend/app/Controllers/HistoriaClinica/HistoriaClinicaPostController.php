<?php

namespace App\Controllers\HistoriaClinica;

use App\Controllers\BaseController;
use App\Services\HistoriaClinica\HistoriaClinicaCreatorService;

class HistoriaClinicaPostController extends BaseController
{
    public function create()
    {
        $data = $this->request->getJSON(true);

        if (empty($data['paciente_id']) || empty($data['diagnostico']) || empty($data['tratamiento'])) {
            return $this->response->setStatusCode(422)->setJSON([
                'error' => 'Faltan campos requeridos: paciente_id, diagnostico y tratamiento',
            ]);
        }

        $usuario = session()->get('usuario');

        $service = new HistoriaClinicaCreatorService();
        $id      = $service->crear($data, $usuario['id']);

        return $this->response->setStatusCode(201)->setJSON(['id' => $id]);
    }
}
