<?php

namespace App\Services\Visita;

use App\Exception\Visita\VisitaNotFoundException;
use App\Models\VisitaModel;

final class VisitaFinderService
{
    private VisitaModel $visitaModel;

    public function __construct()
    {
        $this->visitaModel = new VisitaModel();
    }

    public function buscarPorId(int $id): array
    {
        $visita = $this->visitaModel->obtenerConDetalle($id);

        if ($visita === null) {
            throw new VisitaNotFoundException($id);
        }

        return $visita;
    }
}
