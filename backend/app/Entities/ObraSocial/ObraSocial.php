<?php

namespace App\Entities\ObraSocial;

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