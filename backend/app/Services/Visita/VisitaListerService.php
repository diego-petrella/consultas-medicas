<?php

namespace App\Services\Visita;

use App\Models\VisitaModel;

/**
 * Lista visitas aplicando filtros opcionales.
 */
final class VisitaListerService
{
    private VisitaModel $visitaModel;

    public function __construct()
    {
        $this->visitaModel = new VisitaModel();
    }

    /**
     * Delega directamente en VisitaModel::listarConFiltros().
     */
    public function listar(array $filtros): array
    {
        return $this->visitaModel->listarConFiltros($filtros);
    }
}
