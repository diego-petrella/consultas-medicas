<?php

namespace App\Exception\HistoriaClinica;

use Exception;

final class HistoriaClinicaNotFoundException extends Exception
{
    public function __construct(int $id)
    {
        parent::__construct("Historia clinica con ID {$id} no encontrada", 404);
    }
}
