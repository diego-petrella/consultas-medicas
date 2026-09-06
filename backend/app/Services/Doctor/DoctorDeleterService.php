<?php

namespace App\Services\Doctor;

use App\Exception\Doctor\DoctorNotFoundException;
use App\Models\DoctorModel;

final class DoctorDeleterService
{
    private DoctorModel $doctorModel;

    public function __construct()
    {
        $this->doctorModel = new DoctorModel();
    }

    public function eliminar(int $id): void
    {
        if ($this->doctorModel->find($id) === null) {
            throw new DoctorNotFoundException($id);
        }

        $this->doctorModel->update($id, ['activo' => 0]);
    }
}
