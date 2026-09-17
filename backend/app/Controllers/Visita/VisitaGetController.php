<?php

namespace App\Controllers\Visita;

use App\Controllers\BaseController;
use App\Models\DoctorModel;
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

    public function mias()
    {
        $usuario     = session()->get('usuario');
        $doctorModel = new DoctorModel();
        $doctor      = $doctorModel->obtenerPorUserId($usuario['id']);

        if ($doctor === null) {
            return $this->response->setStatusCode(422)->setJSON([
                'error' => 'No se encontro un doctor asociado al usuario logueado.',
            ]);
        }

        $service = new VisitaListerService();
        $visitas = $service->listar(['doctor_id' => $doctor['id']]);

        return $this->response->setStatusCode(200)->setJSON($visitas);
    }
}
