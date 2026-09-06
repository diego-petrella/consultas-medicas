<?php

namespace App\Controllers\Visita;

use App\Controllers\BaseController;
use App\Services\Visita\VisitaDeleterService;

class VisitaDeleteController extends BaseController
{
    public function delete(int $id)
    {
        $service = new VisitaDeleterService();
        $service->eliminar($id);

        return $this->response->setStatusCode(200)->setJSON(['id' => $id]);
    }
}
