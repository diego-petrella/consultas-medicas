<?php

namespace App\Controllers\ObraSocial;

use App\Dto\Request\ObraSocial\ObraSocialFilterRequest;
use App\Dto\Request\PaginationRequest;
use App\Services\ObraSocial\ObraSocialesSearcherService;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

final class ObraSocialesGetController extends ResourceController
{
    private ObraSocialesSearcherService $obraSocialesSearcherService;

    public function __construct()
    {
        $this->obraSocialesSearcherService = new ObraSocialesSearcherService();
    }

    public function search(): ResponseInterface
    {
        $params  = $this->request->getGet();
        $request = new ObraSocialFilterRequest(
            nombre: $params['nombre'] ?? null,
            pagination: new PaginationRequest(
                page: (int) ($params['page'] ?? 1),
                size: (int) ($params['size'] ?? 10),
            ),
        );

        return $this->response->setJSON(
            $this->obraSocialesSearcherService->searchResponses($request)
        );
    }
}
