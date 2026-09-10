<?php

namespace App\Services\ObraSocial;

use App\Converter\ObraSocial\ObraSocialToObraSocialResponseConverter;
use App\Dto\Request\ObraSocial\ObraSocialRequest;
use App\Dto\Response\ObraSocial\ObraSocialResponse;
use App\Entity\ObraSocial\ObraSocial;
use App\Exception\ObraSocial\ObraSocialNombreYaExisteException;
use App\Models\ObraSocialModel;

final class ObraSocialCreatorService
{
    private ObraSocialModel $obraSocialModel;
    private ObraSocialToObraSocialResponseConverter $converter;

    public function __construct()
    {
        $this->obraSocialModel = new ObraSocialModel();
        $this->converter       = new ObraSocialToObraSocialResponseConverter();
    }

    public function create(ObraSocialRequest $request): ObraSocialResponse
    {
        if ($this->obraSocialModel->buscarPorNombre($request->getNombre()) !== null) {
            throw new ObraSocialNombreYaExisteException($request->getNombre());
        }

        $obraSocial    = ObraSocial::convertFromRequest($request);
        $newObraSocial = $this->obraSocialModel->insert($obraSocial);

        return $this->converter->convert($newObraSocial);
    }
}
