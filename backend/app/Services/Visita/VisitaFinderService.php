<?php

namespace App\Services\Visita;

use App\Dto\Response\Visita\VisitaResponse;
use App\Entity\Visita\Visita;
use App\Exception\Visita\VisitaNotFoundException;
use App\Models\VisitaModel;

final class VisitaFinderService
{
    private VisitaModel $visitaModel;

    public function __construct()
    {
        $this->visitaModel = new VisitaModel();
    }

    public function find(int $id): Visita
    {
        $visita = $this->visitaModel->find($id);

        if ($visita === null) {
            throw new VisitaNotFoundException($id);
        }

        return $visita;
    }

    public function buscarPorId(int $id): VisitaResponse
    {
        $response = $this->visitaModel->buscarConDetalle($id);

        if ($response === null) {
            throw new VisitaNotFoundException($id);
        }

        return $response;
    }
}
