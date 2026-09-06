<?php

namespace App\Services\Visita;

use App\Models\VisitaModel;

final class VisitaListerService
{
    private VisitaModel $visitaModel;

    public function __construct()
    {
        $this->visitaModel = new VisitaModel();
    }

    public function listar(array $filtros): array
    {
        return $this->visitaModel->listarConFiltros($filtros);
    }
}
