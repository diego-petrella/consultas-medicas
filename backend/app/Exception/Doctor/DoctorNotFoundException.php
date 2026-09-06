<?php

namespace App\Exception\Doctor;

use Exception;

final class DoctorNotFoundException extends Exception
{
    public function __construct(int $id)
    {
        parent::__construct("Doctor con ID {$id} no encontrado", 404);
    }
}
