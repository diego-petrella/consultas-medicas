<?php

namespace App\Controllers\ObraSocial;

use App\Services\ObraSocial\ObraSocialFinderService;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

final class ObraSocialGetController extends ResourceController
{
    private ObraSocialFinderService $obraSocialFinderService;

    public function __construct()
    {
        $this->obraSocialFinderService = new ObraSocialFinderService();
    }

    public function find(int $id): ResponseInterface
    {
        $response = $this->obraSocialFinderService->findResponse($id);

        return $this->response->setJSON($response);
    }
}
