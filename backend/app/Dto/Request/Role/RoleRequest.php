<?php

namespace App\Dto\Request\Role;

final readonly class RoleRequest
{
    public function __construct(
        private string $nombre,
    ) {}

    public function getNombre(): string
    {
        return $this->nombre;
    }
}
