<?php

namespace App\Controllers\Doctor;

use App\Controllers\BaseController;
use App\Models\DoctorModel;
use App\Models\UserModel;
use App\Services\Doctor\DoctorCreatorService;

class DoctorPostController extends BaseController
{
    public function create()
    {
        $data = $this->request->getJSON(true);

        $requeridos = ['username', 'password', 'nombre', 'apellido', 'matricula'];
        $faltantes  = array_filter($requeridos, fn ($campo) => empty($data[$campo]));

        if (! empty($faltantes)) {
            return $this->response->setStatusCode(422)->setJSON([
                'error' => 'Faltan campos requeridos: ' . implode(', ', $faltantes),
            ]);
        }

        $userModel = new UserModel();
        if ($userModel->buscarPorUsername($data['username']) !== null) {
            return $this->response->setStatusCode(409)->setJSON([
                'error' => 'Ya existe un usuario con ese username',
            ]);
        }

        $doctorModel = new DoctorModel();
        if ($doctorModel->buscarPorMatricula($data['matricula']) !== null) {
            return $this->response->setStatusCode(409)->setJSON([
                'error' => 'Ya existe un doctor con esa matricula',
            ]);
        }

        $service = new DoctorCreatorService();
        $id      = $service->crear($data);

        return $this->response->setStatusCode(201)->setJSON(['id' => $id]);
    }
}
