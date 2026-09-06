<?php

namespace App\Services\Doctor;

use App\Exception\Doctor\DoctorNotFoundException;
use App\Models\DoctorModel;
use App\Models\UserModel;

final class DoctorUpdaterService
{
    private DoctorModel $doctorModel;
    private UserModel $userModel;

    public function __construct()
    {
        $this->doctorModel = new DoctorModel();
        $this->userModel   = new UserModel();
    }

    public function actualizar(int $id, array $datos): void
    {
        $doctor = $this->doctorModel->find($id);

        if ($doctor === null) {
            throw new DoctorNotFoundException($id);
        }

        $this->doctorModel->update($id, [
            'especialidad' => $datos['especialidad'] ?? null,
            'telefono'     => $datos['telefono'] ?? null,
        ]);

        $this->userModel->update($doctor['user_id'], [
            'nombre'   => $datos['nombre'],
            'apellido' => $datos['apellido'],
        ]);
    }
}
