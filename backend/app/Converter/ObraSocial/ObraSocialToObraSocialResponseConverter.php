<?php

namespace App\Converter\ObraSocial;

use App\Dto\Response\ObraSocial\ObraSocialResponse;
use App\Entity\ObraSocial\ObraSocial;

final class ObraSocialToObraSocialResponseConverter
{
    public function convert(ObraSocial $obraSocial): ObraSocialResponse
    {
        return new ObraSocialResponse(
            id: $obraSocial->getId(),
            nombre: $obraSocial->getNombre(),
        );
    }
}
