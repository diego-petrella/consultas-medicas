<?php

namespace App\Converter\User;

use App\Dto\Response\User\UserResponse;
use App\Entity\User\User;

final class UserToUserResponseConverter
{
    public function convert(User $user): UserResponse
    {
        return new UserResponse(
            id: $user->getId(),
            username: $user->getUsername(),
            nombre: $user->getNombre(),
            apellido: $user->getApellido(),
            roleId: $user->getRoleId(),
            activo: $user->getActivo(),
            createdAt: $user->getCreatedAt(),
        );
    }
}
