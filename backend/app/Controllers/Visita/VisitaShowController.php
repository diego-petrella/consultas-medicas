<?php

namespace App\Controllers\Visita;

use App\Controllers\BaseController;
use App\Services\Visita\VisitaFinderService;

class VisitaShowController extends BaseController
{
    public function show(int $id)
    {
        $service = new VisitaFinderService();
        $visita  = $service->buscarPorId($id);

        return $this->response->setStatusCode(200)->setJSON($visita);
    }
}
