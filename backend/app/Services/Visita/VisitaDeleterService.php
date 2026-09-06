<?php

namespace App\Services\Visita;

use App\Exception\Visita\VisitaNotFoundException;
use App\Models\VisitaModel;

final class VisitaDeleterService
{
    private VisitaModel $visitaModel;

    public function __construct()
    {
        $this->visitaModel = new VisitaModel();
    }

    public function eliminar(int $id): void
    {
        if ($this->visitaModel->find($id) === null) {
            throw new VisitaNotFoundException($id);
        }

        $this->visitaModel->update($id, ['estado' => 0]);
    }
}
