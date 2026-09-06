<?php

namespace App\Controllers\Visita;

use App\Controllers\BaseController;
use App\Services\Visita\VisitaUpdaterService;

class VisitaPutController extends BaseController
{
    public function put(int $id)
    {
        $data = $this->request->getJSON(true);

        $service = new VisitaUpdaterService();
        $service->actualizar($id, $data);

        return $this->response->setStatusCode(200)->setJSON(['id' => $id]);
    }
}
