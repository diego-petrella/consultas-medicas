<?php

namespace App\Controllers\ObraSocial;

use App\Converter\ObraSocial\ObraSocialToObraSocialResponseConverter;
use App\Models\ObraSocialModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

final class ObraSocialActivasController extends ResourceController
{
    private ObraSocialModel $obraSocialModel;
    private ObraSocialToObraSocialResponseConverter $converter;

    public function __construct()
    {
        $this->obraSocialModel = new ObraSocialModel();
        $this->converter       = new ObraSocialToObraSocialResponseConverter();
    }

    public function activas(): ResponseInterface
    {
        $entities  = $this->obraSocialModel->listarActivas();
        $responses = [];

        foreach ($entities as $entity) {
            $responses[] = $this->converter->convert($entity);
        }

        return $this->response->setJSON($responses);
    }
}
