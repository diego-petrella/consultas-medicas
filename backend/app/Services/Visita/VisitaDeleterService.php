<?php

namespace App\Services\Visita;

use App\Models\VisitaModel;

final class VisitaDeleterService
{
    private VisitaModel $visitaModel;
    private VisitaFinderService $visitaFinderService;

    public function __construct()
    {
        $this->visitaModel         = new VisitaModel();
        $this->visitaFinderService = new VisitaFinderService();
    }

    public function eliminar(int $id): void
    {
        $visita = $this->visitaFinderService->find($id);
        $this->visitaModel->delete($visita->getId());
    }
}
