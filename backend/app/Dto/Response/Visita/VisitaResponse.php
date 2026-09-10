<?php

namespace App\Dto\Response\Visita;

final readonly class VisitaResponse
{
    public function __construct(
        public int $id,
        public string $fecha,
        public int $pacienteId,
        public string $pacienteDni,
        public string $pacienteNombre,
        public string $pacienteApellido,
        public int $doctorId,
        public string $doctorNombre,
        public string $doctorApellido,
        public ?int $obraSocialId,
        public ?string $obraSocialNombre,
        public int $estado,
    ) {}
}
