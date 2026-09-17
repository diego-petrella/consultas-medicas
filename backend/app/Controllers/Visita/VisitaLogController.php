<?php

namespace App\Controllers\Visita;

use App\Controllers\BaseController;
use App\Models\VisitaLogModel;

class VisitaLogController extends BaseController
{
    public function log(int $id)
    {
        $model = new VisitaLogModel();
        $log   = $model->obtenerPorVisita($id);

        return $this->response->setStatusCode(200)->setJSON($log);
    }
}
