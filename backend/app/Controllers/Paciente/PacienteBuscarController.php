<?php

namespace App\Controllers\Paciente;

use App\Controllers\BaseController;
use App\Models\PacienteModel;

class PacienteBuscarController extends BaseController
{
    public function buscar()
    {
        $dni = $this->request->getGet('dni');

        if (empty($dni)) {
            return $this->response->setStatusCode(422)->setJSON([
                'error' => 'Falta el parametro requerido: dni',
            ]);
        }

        $pacienteModel = new PacienteModel();
        $paciente      = $pacienteModel->buscarPorDni($dni);

        if ($paciente === null) {
            return $this->response->setStatusCode(200)->setJSON([
                'encontrado' => false,
            ]);
        }

        return $this->response->setStatusCode(200)->setJSON([
            'encontrado' => true,
            'paciente'   => $pacienteModel->obtenerConObraSocial($paciente['id']),
        ]);
    }
}
