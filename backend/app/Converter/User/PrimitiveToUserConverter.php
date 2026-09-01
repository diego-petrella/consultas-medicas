<?php

namespace App\Converter\User;

use App\Entity\User\User;

final class PrimitiveToUserConverter
{
    public function convert(object $primitive): User
    {
        return new User(
            (int) $primitive->id,
            $primitive->username,
            $primitive->password,
            $primitive->nombre,
            $primitive->apellido,
            (int) $primitive->role_id,
            $primitive->created_at,
        );
    }
}
