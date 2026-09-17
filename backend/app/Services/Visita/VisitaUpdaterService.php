<?php

namespace App\Services\Visita;

use App\Entity\Visita\Visita;
use App\Exception\Visita\VisitaSuperpuestaException;
use App\Models\VisitaModel;

final class VisitaUpdaterService
{
    private VisitaModel $visitaModel;
    private VisitaFinderService $visitaFinderService;

    public function __construct()
    {
        $this->visitaModel         = new VisitaModel();
        $this->visitaFinderService = new VisitaFinderService();
    }

    public function actualizar(int $id, array $datos): void
    {
        $visita = $this->visitaFinderService->find($id);

        $doctorId = (int) $datos['doctor_id'];

        if ($this->visitaModel->existeSuperposicion($doctorId, $datos['fecha'], $id)) {
            throw new VisitaSuperpuestaException();
        }

        $actualizada = new Visita(
            id: $visita->getId(),
            fecha: $datos['fecha'],
            pacienteId: $visita->getPacienteId(),
            doctorId: $doctorId,
            obraSocialId: isset($datos['obra_social_id']) ? (int) $datos['obra_social_id'] : null,
            estado: $visita->getEstado(),
        );

        $this->visitaModel->update($actualizada);
    }
}
