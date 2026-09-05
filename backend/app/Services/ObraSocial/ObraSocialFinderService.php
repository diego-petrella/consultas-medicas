<?php

namespace App\Services\ObraSocial;

use App\Converter\ObraSocial\ObraSocialToObraSocialResponseConverter;
use App\Dto\Response\ObraSocial\ObraSocialResponse;
use App\Entity\ObraSocial\ObraSocial;
use App\Exception\ObraSocial\ObraSocialNotFoundException;
use App\Models\ObraSocialModel;

final class ObraSocialFinderService
{
    private ObraSocialModel $obraSocialModel;
    private ObraSocialToObraSocialResponseConverter $converter;

    public function __construct()
    {
        $this->obraSocialModel = new ObraSocialModel();
        $this->converter       = new ObraSocialToObraSocialResponseConverter();
    }

    public function find(int $id): ObraSocial
    {
        $obraSocial = $this->obraSocialModel->find($id);

        if (empty($obraSocial)) {
            throw new ObraSocialNotFoundException($id);
        }

        return $obraSocial;
    }

    public function findResponse(int $id): ObraSocialResponse
    {
        return $this->converter->convert($this->find($id));
    }
}
