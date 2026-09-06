<?php

namespace App\Converter\Role;

use App\Entity\Role\Role;

final class PrimitiveToRoleConverter
{
    public function convert(object $primitive): Role
    {
        return new Role(
            id: (int) $primitive->id,
            nombre: $primitive->nombre,
        );
    }
}
