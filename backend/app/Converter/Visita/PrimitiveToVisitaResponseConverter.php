<?php

namespace App\Converter\Visita;

use App\Dto\Response\Visita\VisitaResponse;

final class PrimitiveToVisitaResponseConverter
{
    public function convert(object $primitive): VisitaResponse
    {
        return new VisitaResponse(
            id: (int) $primitive->id,
            fecha: $primitive->fecha,
            pacienteDni: $primitive->paciente_dni,
            pacienteNombre: $primitive->paciente_nombre,
            pacienteApellido: $primitive->paciente_apellido,
            doctorNombre: $primitive->doctor_nombre,
            doctorApellido: $primitive->doctor_apellido,
            obraSocialNombre: $primitive->obra_social_nombre,
            estado: (int) $primitive->estado,
        );
    }
}
