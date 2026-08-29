<?php

namespace App\Entity\ObrasSociales;

final class ObraSocial
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