<?php

namespace App\Controllers\ObraSocial;

use App\Services\ObraSocial\ObraSocialDeleterService;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

final class ObraSocialDeleteController extends ResourceController
{
    private ObraSocialDeleterService $obraSocialDeleterService;

    public function __construct()
    {
        $this->obraSocialDeleterService = new ObraSocialDeleterService();
    }

    public function do(int $id): ResponseInterface
    {
        $this->obraSocialDeleterService->delete($id);

        return $this->response->setJSON(['id' => $id]);
    }
}
