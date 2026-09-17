<?php

namespace App\Exception\Visita;

use Exception;

final class VisitaSuperpuestaException extends Exception
{
    public function __construct()
    {
        parent::__construct('El doctor ya tiene una visita agendada en ese horario', 409);
    }
}
