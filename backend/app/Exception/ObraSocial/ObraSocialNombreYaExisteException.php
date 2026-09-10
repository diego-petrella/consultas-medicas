<?php

namespace App\Exception\ObraSocial;

use Exception;

final class ObraSocialNombreYaExisteException extends Exception
{
    public function __construct(string $nombre)
    {
        parent::__construct("Ya existe una obra social con nombre {$nombre}", 409);
    }
}
