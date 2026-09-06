<?php

namespace App\Dto\Response\Doctor;

final readonly class DoctorResponse
{
    public function __construct(
        public int $id,
        public string $matricula,
        public ?string $especialidad,
        public ?string $telefono,
        public int $activo,
        public string $username,
        public string $nombre,
        public string $apellido,
    ) {}
}
