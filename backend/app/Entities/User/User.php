<?php

namespace App\Entities\User;

use CodeIgniter\Entity\Entity;

class User extends Entity
{
    protected $attributes = [
        'id'         => null,
        'username'   => null,
        'password'   => null,
        'nombre'     => null,
        'apellido'   => null,
        'role_id'    => null,
        'created_at' => null,
    ];

    public function setPassword(string $password): static
    {
        $this->attributes['password'] = password_hash($password, PASSWORD_BCRYPT);

        return $this;
    }
}
