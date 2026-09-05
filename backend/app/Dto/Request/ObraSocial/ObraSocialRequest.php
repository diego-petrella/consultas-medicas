<?php

namespace App\Dto\Request\ObraSocial;

final readonly class ObraSocialRequest
{
    public function __construct(
        private string $nombre,
    ) {}

    public function getNombre(): string
    {
        return $this->nombre;
    }
}
