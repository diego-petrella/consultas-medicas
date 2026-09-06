<?php

namespace App\Converter\Doctor;

use App\Dto\Response\Doctor\DoctorResponse;

final class PrimitiveToDoctorResponseConverter
{
    public function convert(object $primitive): DoctorResponse
    {
        return new DoctorResponse(
            id: (int) $primitive->id,
            matricula: $primitive->matricula,
            especialidad: $primitive->especialidad,
            telefono: $primitive->telefono,
            activo: (int) $primitive->activo,
            username: $primitive->username,
            nombre: $primitive->nombre,
            apellido: $primitive->apellido,
        );
    }
}
