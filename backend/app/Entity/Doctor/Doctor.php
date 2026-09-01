<?php


namespace App\Entity\Doctor;


final class Doctor {
    public function __construct(
        private ?int $id,
        private int $user_id,
        private string $matricula,
        private string $especialidad,
        private string $telefono,
        private string $created_at
    )
    {}


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getMatricula(): string
    {
        return $this->matricula;
    }

    public function getEspecialidad(): string
    {
        return $this->especialidad;
    }

    public function getTelefono(): string
    {
        return $this->telefono;
    }

     public function getCreatedAt(): string
    {
        return $this->created_at;
    }
}