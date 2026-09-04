<?php

namespace App\Services\ObraSocial;

use App\Converter\ObraSocial\ObraSocialToObraSocialResponseConverter;
use App\Dto\Request\ObraSocial\ObraSocialFilterRequest;
use App\Models\ObraSocialModel;

final class ObraSocialesSearcherService
{
    private ObraSocialModel $obraSocialModel;
    private ObraSocialToObraSocialResponseConverter $converter;

    public function __construct()
    {
        $this->obraSocialModel = new ObraSocialModel();
        $this->converter       = new ObraSocialToObraSocialResponseConverter();
    }

    public function searchResponses(ObraSocialFilterRequest $request): array
    {
        $entities  = $this->obraSocialModel->search($request);
        $responses = [];

        foreach ($entities as $entity) {
            $responses[] = $this->converter->convert($entity);
        }

        return $responses;
    }
}
