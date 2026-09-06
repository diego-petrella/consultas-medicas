<?php

namespace App\Entity\Role;

use App\Dto\Request\Role\RoleRequest;

final class Role
{
    public function __construct(
        private ?int $id,
        private string $nombre
    ) {}

    public static function convertFromRequest(RoleRequest $request): Role
    {
        return new Role(
            id: null,
            nombre: $request->getNombre(),
        );
    }

    public function update(RoleRequest $request): void
    {
        $this->nombre = $request->getNombre();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }
}
