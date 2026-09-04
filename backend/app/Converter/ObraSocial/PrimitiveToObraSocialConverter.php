<?php

namespace App\Converter\ObraSocial;

use App\Entity\ObraSocial\ObraSocial;

final class PrimitiveToObraSocialConverter
{
    public function convert(object $primitive): ObraSocial
    {
        return new ObraSocial(
            id: (int) $primitive->id,
            nombre: $primitive->nombre,
        );
    }
}
