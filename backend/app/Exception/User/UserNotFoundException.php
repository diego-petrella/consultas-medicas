<?php

namespace App\Exception\User;

use Exception;

final class UserNotFoundException extends Exception
{
    public function __construct(int $id)
    {
        parent::__construct("Usuario con ID {$id} no encontrado", 404);
    }
}
