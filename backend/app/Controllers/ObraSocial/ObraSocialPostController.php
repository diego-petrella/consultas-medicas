<?php

namespace App\Controllers\ObraSocial;

use App\Dto\Request\ObraSocial\ObraSocialRequest;
use App\Services\ObraSocial\ObraSocialCreatorService;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

final class ObraSocialPostController extends ResourceController
{
    private ObraSocialCreatorService $obraSocialCreatorService;

    public function __construct()
    {
        $this->obraSocialCreatorService = new ObraSocialCreatorService();
    }

    public function create(): ResponseInterface
    {
        $request  = $this->getRequest();
        $response = $this->obraSocialCreatorService->create($request);

        return $this->response->setStatusCode(201)->setJSON($response);
    }

    private function getRequest(): ObraSocialRequest
    {
        $body = $this->request->getJSON();

        return new ObraSocialRequest(
            nombre: $body->nombre ?? '',
        );
    }
}
