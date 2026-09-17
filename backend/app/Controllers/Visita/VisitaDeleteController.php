<?php

namespace App\Controllers\Visita;

use App\Controllers\BaseController;
use App\Services\Visita\VisitaDeleterService;

class VisitaDeleteController extends BaseController
{
    public function delete(int $id)
    {
        $usuario = session()->get('usuario');

        $service = new VisitaDeleterService();
        $service->eliminar($id, $usuario['id']);

        return $this->response->setStatusCode(200)->setJSON(['id' => $id]);
    }
}
