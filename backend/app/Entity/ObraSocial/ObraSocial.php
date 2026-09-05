<?php

namespace App\Entity\ObraSocial;

use App\Dto\Request\ObraSocial\ObraSocialRequest;

final class ObraSocial
{
    public function __construct(
        private ?int $id,
        private string $nombre
    ) {}

    public static function convertFromRequest(ObraSocialRequest $request): ObraSocial
    {
        return new ObraSocial(
            id: null,
            nombre: $request->getNombre(),
        );
    }

    public function update(ObraSocialRequest $request): void
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