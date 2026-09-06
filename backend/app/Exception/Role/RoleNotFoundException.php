<?php

namespace App\Exception\Role;

use Exception;

final class RoleNotFoundException extends Exception
{
    public function __construct(int $id)
    {
        parent::__construct("Role con ID {$id} no encontrado", 404);
    }
}
