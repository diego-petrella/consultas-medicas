<?php

namespace App\Exception\HistoriaClinica;

use Exception;

final class HistoriaClinicaNotFoundException extends Exception
{
    public function __construct(int $id)
    {
        parent::__construct("Historia clinica with id {$id} not found", 404);
    }
}
