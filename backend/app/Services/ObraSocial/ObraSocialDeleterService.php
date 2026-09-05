<?php

namespace App\Services\ObraSocial;

use App\Models\ObraSocialModel;

final class ObraSocialDeleterService
{
    private ObraSocialModel $obraSocialModel;
    private ObraSocialFinderService $obraSocialFinderService;

    public function __construct()
    {
        $this->obraSocialModel         = new ObraSocialModel();
        $this->obraSocialFinderService = new ObraSocialFinderService();
    }

    public function delete(int $id): void
    {
        $obraSocial = $this->obraSocialFinderService->find($id);
        $this->obraSocialModel->delete($obraSocial->getId());
    }
}
