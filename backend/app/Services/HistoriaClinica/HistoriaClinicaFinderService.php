<?php

namespace App\Services\HistoriaClinica;

use App\Exception\HistoriaClinica\HistoriaClinicaNotFoundException;
use App\Models\HistoriaClinicaModel;

final class HistoriaClinicaFinderService
{
    private HistoriaClinicaModel $historiaClinicaModel;

    public function __construct()
    {
        $this->historiaClinicaModel = new HistoriaClinicaModel();
    }

    public function buscarPorId(int $id): array
    {
        $historia = $this->historiaClinicaModel->obtenerConDetalle($id);

        if ($historia === null) {
            throw new HistoriaClinicaNotFoundException($id);
        }

        return $historia;
    }
}
