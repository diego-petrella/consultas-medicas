<?php

namespace App\Dto\Response\ObraSocial;

final readonly class ObraSocialResponse
{
    public function __construct(
        public int $id,
        public string $nombre,
    ) {}
}
