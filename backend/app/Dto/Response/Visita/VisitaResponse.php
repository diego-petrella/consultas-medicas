<?php

namespace App\Dto\Response\Visita;

final readonly class VisitaResponse
{
    public function __construct(
        public int $id,
        public string $fecha,
        public string $pacienteDni,
        public string $pacienteNombre,
        public string $pacienteApellido,
        public string $doctorNombre,
        public string $doctorApellido,
        public ?string $obraSocialNombre,
        public int $estado,
    ) {}
}
