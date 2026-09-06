<?php

namespace App\Services\Doctor;

use App\Models\DoctorModel;

final class DoctorDeleterService
{
    private DoctorModel $doctorModel;
    private DoctorFinderService $doctorFinderService;

    public function __construct()
    {
        $this->doctorModel         = new DoctorModel();
        $this->doctorFinderService = new DoctorFinderService();
    }

    public function eliminar(int $id): void
    {
        $doctor = $this->doctorFinderService->find($id);
        $this->doctorModel->delete($doctor->getId());
    }
}
