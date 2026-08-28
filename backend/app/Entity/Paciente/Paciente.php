<?php

namespace App\Entity\Paciente;

final class Paciente {

    public function _construct(

    private ?int $id,
    private int $dni,
    private string $nombre,
    private string $apellido,
    private string $fechanacimiento,
    private int $obrasocialid,
    private string $createat
    )
{}

public function getId(): ?int
{
    return $this->id;
}


public function getDni(): int
{
    return $this->dni;
}


public function getNombre(): string
{
    return $this->nombre;
}


public function getApellido(): string
{
    return $this->apellido;
}


public function getFechadenacimiento(): string
{
    return $this->fechanacimiento;
}


public function getObresocial(): int
{
    return $this->obrasocialid;
}

public function getCreateat(): string
{
    return $this->createat;
}







    }


