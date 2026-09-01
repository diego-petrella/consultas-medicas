<?php

namespace App\Entities\Paciente;

final class Paciente
{
    public function __construct(
        private ?int $id,
        private int $dni,
        private string $nombre,
        private string $apellido,
        private string $fecha_nacimiento,
        private int $obra_social_id,
        private string $created_at
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDni(): int
    {
        return $this->dni;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getApellido(): string
    {
        return $this->apellido;
    }

    public function getFechaNacimiento(): string
    {
        return $this->fecha_nacimiento;
    }

    public function getObraSocialId(): int
    {
        return $this->obra_social_id;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }
}


