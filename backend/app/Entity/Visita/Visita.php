<?php

namespace App\Entity\Visita;

final class Visita
{
    public function __construct(
        private ?int $id,
        private string $fecha,
        private int $pacienteId,
        private int $doctorId,
        private ?int $obraSocialId,
        private int $estado
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): string
    {
        return $this->fecha;
    }

    public function getPacienteId(): int
    {
        return $this->pacienteId;
    }

    public function getDoctorId(): int
    {
        return $this->doctorId;
    }

    public function getObraSocialId(): ?int
    {
        return $this->obraSocialId;
    }

    public function getEstado(): int
    {
        return $this->estado;
    }
}
