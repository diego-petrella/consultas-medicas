<?php

namespace App\Services\Doctor;

use App\Entity\Doctor\Doctor;
use App\Exception\Doctor\DoctorNotFoundException;
use App\Models\DoctorModel;

final class DoctorFinderService
{
    private DoctorModel $doctorModel;

    public function __construct()
    {
        $this->doctorModel = new DoctorModel();
    }

    public function find(int $id): Doctor
    {
        $doctor = $this->doctorModel->find($id);

        if ($doctor === null) {
            throw new DoctorNotFoundException($id);
        }

        return $doctor;
    }
}
