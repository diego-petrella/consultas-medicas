<?php

namespace App\Services\Doctor;

use App\Exception\Doctor\DoctorNotFoundException;
use App\Models\DoctorModel;

final class DoctorFinderService
{
    private DoctorModel $doctorModel;

    public function __construct()
    {
        $this->doctorModel = new DoctorModel();
    }

    public function buscarPorId(int $id): array
    {
        $doctor = $this->doctorModel->obtenerConUsuario($id);

        if ($doctor === null) {
            throw new DoctorNotFoundException($id);
        }

        return $doctor;
    }
}
