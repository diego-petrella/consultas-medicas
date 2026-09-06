<?php

namespace App\Converter\Doctor;

use App\Entity\Doctor\Doctor;

final class PrimitiveToDoctorConverter
{
    public function convert(object $primitive): Doctor
    {
        return new Doctor(
            id: (int) $primitive->id,
            user_id: (int) $primitive->user_id,
            matricula: $primitive->matricula,
            especialidad: $primitive->especialidad,
            telefono: $primitive->telefono,
            activo: (int) $primitive->activo,
            created_at: $primitive->created_at,
        );
    }
}
