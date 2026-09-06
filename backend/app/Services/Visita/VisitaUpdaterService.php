<?php

namespace App\Services\Visita;

use App\Exception\Visita\VisitaNotFoundException;
use App\Models\VisitaModel;

final class VisitaUpdaterService
{
    private VisitaModel $visitaModel;

    public function __construct()
    {
        $this->visitaModel = new VisitaModel();
    }

    public function actualizar(int $id, array $datos): void
    {
        if ($this->visitaModel->find($id) === null) {
            throw new VisitaNotFoundException($id);
        }

        $this->visitaModel->update($id, [
            'doctor_id'      => $datos['doctor_id'],
            'obra_social_id' => $datos['obra_social_id'] ?? null,
            'fecha'          => $datos['fecha'],
        ]);
    }
}
