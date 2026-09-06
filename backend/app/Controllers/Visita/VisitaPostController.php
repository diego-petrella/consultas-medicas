<?php

namespace App\Controllers\Visita;

use App\Controllers\BaseController;
use App\Services\Visita\VisitaCreatorService;

class VisitaPostController extends BaseController
{
    public function create()
    {
        $data = $this->request->getJSON(true);

        $requeridos = ['dni', 'nombre', 'apellido', 'doctor_id', 'fecha'];
        $faltantes  = array_filter($requeridos, fn ($campo) => empty($data[$campo]));

        if (! empty($faltantes)) {
            return $this->response->setStatusCode(422)->setJSON([
                'error' => 'Faltan campos requeridos: ' . implode(', ', $faltantes),
            ]);
        }

        $service = new VisitaCreatorService();
        $id      = $service->crear($data);

        return $this->response->setStatusCode(201)->setJSON(['id' => $id]);
    }
}
