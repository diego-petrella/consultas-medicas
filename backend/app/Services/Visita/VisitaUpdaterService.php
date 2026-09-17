<?php

namespace App\Services\Visita;

use App\Entity\Visita\Visita;
use App\Models\VisitaLogModel;
use App\Models\VisitaModel;

final class VisitaUpdaterService
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

    public function actualizar(int $id, array $datos, int $usuarioId): void
    {
        $visita = $this->visitaFinderService->find($id);

        $actualizada = new Visita(
            id: $visita->getId(),
            fecha: $datos['fecha'],
            pacienteId: $visita->getPacienteId(),
            doctorId: (int) $datos['doctor_id'],
            obraSocialId: isset($datos['obra_social_id']) ? (int) $datos['obra_social_id'] : null,
            estado: $visita->getEstado(),
        );

        $datosAnteriores = [
            'fecha'          => $visita->getFecha(),
            'paciente_id'    => $visita->getPacienteId(),
            'doctor_id'      => $visita->getDoctorId(),
            'obra_social_id' => $visita->getObraSocialId(),
            'estado'         => $visita->getEstado(),
        ];

        $datosNuevos = [
            'fecha'          => $actualizada->getFecha(),
            'paciente_id'    => $actualizada->getPacienteId(),
            'doctor_id'      => $actualizada->getDoctorId(),
            'obra_social_id' => $actualizada->getObraSocialId(),
            'estado'         => $actualizada->getEstado(),
        ];

        $this->visitaModel->update($actualizada);

        $this->visitaLogModel->registrar($id, $usuarioId, 'actualizacion', $datosAnteriores, $datosNuevos);
    }
}
