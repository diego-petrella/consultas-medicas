<?php

namespace App\Converter\Visita;

use App\Entity\Visita\Visita;

final class PrimitiveToVisitaConverter
{
    public function convert(object $primitive): Visita
    {
        return new Visita(
            id: (int) $primitive->id,
            fecha: $primitive->fecha,
            pacienteId: (int) $primitive->paciente_id,
            doctorId: (int) $primitive->doctor_id,
            obraSocialId: $primitive->obra_social_id !== null ? (int) $primitive->obra_social_id : null,
            estado: (int) $primitive->estado,
        );
    }
}
