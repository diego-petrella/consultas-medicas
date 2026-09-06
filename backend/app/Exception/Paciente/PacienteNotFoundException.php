<?php

namespace App\Exception\Paciente;

use Exception;

final class PacienteNotFoundException extends Exception
{
    public function __construct(int $id)
    {
        parent::__construct("Paciente con ID {$id} no encontrado", 404);
    }
}
