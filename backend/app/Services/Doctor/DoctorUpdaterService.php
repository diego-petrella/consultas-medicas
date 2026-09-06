<?php

namespace App\Services\Doctor;

use App\Entity\Doctor\Doctor;
use App\Models\DoctorModel;
use App\Models\UserModel;

final class DoctorUpdaterService
{
    private DoctorModel $doctorModel;
    private DoctorFinderService $doctorFinderService;
    private UserModel $userModel;

    public function __construct()
    {
        $this->doctorModel         = new DoctorModel();
        $this->doctorFinderService = new DoctorFinderService();
        $this->userModel           = new UserModel();
    }

    public function actualizar(int $id, array $datos): void
    {
        $doctor = $this->doctorFinderService->find($id);

        $actualizado = new Doctor(
            id: $doctor->getId(),
            user_id: $doctor->getUserId(),
            matricula: $doctor->getMatricula(),
            especialidad: $datos['especialidad'] ?? null,
            telefono: $datos['telefono'] ?? null,
            activo: $doctor->getActivo(),
            created_at: $doctor->getCreatedAt(),
        );

        $this->doctorModel->update($actualizado);

        $this->userModel->update($doctor->getUserId(), [
            'nombre'   => $datos['nombre'],
            'apellido' => $datos['apellido'],
        ]);
    }
}
