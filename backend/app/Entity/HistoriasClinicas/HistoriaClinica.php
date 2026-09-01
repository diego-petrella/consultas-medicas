<?php

namespace App\Entity\HistoriasClinicas;


final class HistoriaClinica {
    public function __construct(
        private ?int $id,
        private int $paciente_id,
        private int $doctor_id,
        private string $fecha,
        private string $diagnostico,
        private string $tratamiento,
        private string $observaciones
    ){}

    public function getId() : ?int
    {
        return $this->id;
    }

  public function getPacienteId() : int
    {
        return $this->paciente_id;
    }


      public function getDoctorId() : int
    {
        return $this->doctor_id;
    }

    public function getFecha(): string
    {
        return $this->fecha;
    }

    public function getDiagnostico(): string
    {
        return $this->diagnostico;
    }

    public function getTratamiento(): string
    {
        return $this->tratamiento;
    }

    public function getObservaciones(): string
    {
        return $this->observaciones;
    }

}