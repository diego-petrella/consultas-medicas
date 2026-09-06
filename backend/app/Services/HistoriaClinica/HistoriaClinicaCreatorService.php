<?php

namespace App\Services\HistoriaClinica;

use App\Models\DoctorModel;
use App\Models\HistoriaClinicaModel;
use Exception;

final class HistoriaClinicaCreatorService
{
    private HistoriaClinicaModel $historiaClinicaModel;
    private DoctorModel $doctorModel;

    public function __construct()
    {
        $this->historiaClinicaModel = new HistoriaClinicaModel();
        $this->doctorModel          = new DoctorModel();
    }

    public function crear(array $data, int $userId): int
    {
        $doctor = $this->doctorModel->obtenerPorUserId($userId);

        if ($doctor === null) {
            throw new Exception('No se encontro un doctor asociado al usuario logueado.');
        }

        $id = $this->historiaClinicaModel->insert([
            'paciente_id'   => $data['paciente_id'],
            'doctor_id'     => $doctor['id'],
            'fecha'         => date('Y-m-d H:i:s'),
            'diagnostico'   => $data['diagnostico'],
            'tratamiento'   => $data['tratamiento'],
            'observaciones' => $data['observaciones'] ?? null,
        ]);

        return (int) $id;
    }
}
