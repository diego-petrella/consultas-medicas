<?php

namespace App\Entity\Role;

final class Role
{
    public function __construct(
        private ?int $id,
        private string $nombre
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }
}
