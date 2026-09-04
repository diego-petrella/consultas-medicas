<?php

namespace App\Dto\Request\ObraSocial;

use App\Dto\Request\PaginationRequest;

final readonly class ObraSocialFilterRequest
{
    public function __construct(
        private ?string $nombre,
        private PaginationRequest $pagination,
    ) {}

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function hasNombre(): bool
    {
        return $this->nombre !== null && $this->nombre !== '';
    }

    public function getPagination(): PaginationRequest
    {
        return $this->pagination;
    }
}
