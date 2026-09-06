<?php

namespace App\Controllers\Visita;

use App\Controllers\BaseController;
use App\Services\Visita\VisitaListerService;

class VisitaGetController extends BaseController
{
    public function search()
    {
        $filtros = [
            'dni'            => $this->request->getGet('dni'),
            'fecha'          => $this->request->getGet('fecha'),
            'obra_social_id' => $this->request->getGet('obra_social_id'),
        ];

        $service = new VisitaListerService();
        $visitas = $service->listar($filtros);

        return $this->response->setStatusCode(200)->setJSON($visitas);
    }
}
