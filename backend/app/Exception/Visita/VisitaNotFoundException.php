<?php

namespace App\Exception\Visita;

use Exception;

final class VisitaNotFoundException extends Exception
{
    public function __construct(int $id)
    {
        parent::__construct("Visita con ID {$id} no encontrada", 404);
    }
}
