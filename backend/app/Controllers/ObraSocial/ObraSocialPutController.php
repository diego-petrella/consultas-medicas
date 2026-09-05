<?php

namespace App\Controllers\ObraSocial;

use App\Dto\Request\ObraSocial\ObraSocialRequest;
use App\Services\ObraSocial\ObraSocialUpdaterService;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

final class ObraSocialPutController extends ResourceController
{
    private ObraSocialUpdaterService $obraSocialUpdaterService;

    public function __construct()
    {
        $this->obraSocialUpdaterService = new ObraSocialUpdaterService();
    }

    public function put(int $id): ResponseInterface
    {
        $request  = $this->getRequest();
        $response = $this->obraSocialUpdaterService->update($request, $id);

        return $this->response->setJSON($response);
    }

    private function getRequest(): ObraSocialRequest
    {
        $body = $this->request->getJSON();

        return new ObraSocialRequest(
            nombre: $body->nombre ?? '',
        );
    }
}
