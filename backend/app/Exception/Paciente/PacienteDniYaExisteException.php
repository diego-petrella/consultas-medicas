<?php

namespace App\Exception\Paciente;

use Exception;

final class PacienteDniYaExisteException extends Exception
{
    public function __construct(string $dni)
    {
        parent::__construct("Ya existe un paciente con DNI {$dni}", 409);
    }
}
