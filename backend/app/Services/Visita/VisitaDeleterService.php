<?php

namespace App\Services\Visita;

use App\Models\VisitaLogModel;
use App\Models\VisitaModel;

final class VisitaDeleterService
{
    private VisitaModel $visitaModel;
    private VisitaFinderService $visitaFinderService;
    private VisitaLogModel $visitaLogModel;

    public function __construct()
    {
        $this->visitaModel         = new VisitaModel();
        $this->visitaFinderService = new VisitaFinderService();
        $this->visitaLogModel      = new VisitaLogModel();
    }

    public function eliminar(int $id, int $usuarioId): void
    {
        $visita = $this->visitaFinderService->find($id);

        $datosAnteriores = [
            'fecha'          => $visita->getFecha(),
            'paciente_id'    => $visita->getPacienteId(),
            'doctor_id'      => $visita->getDoctorId(),
            'obra_social_id' => $visita->getObraSocialId(),
            'estado'         => $visita->getEstado(),
        ];

        $this->visitaModel->delete($visita->getId());

        $this->visitaLogModel->registrar($visita->getId(), $usuarioId, 'baja', $datosAnteriores, null);
    }
}
