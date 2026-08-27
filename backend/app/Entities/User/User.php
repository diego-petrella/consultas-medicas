<?php

namespace App\Entities\User;

final class User
{
    public function __construct(
        private ?int $id,
        private string $username,
        private string $password,
        private string $nombre,
        private string $apellido,
        private int $roleId,
        private ?string $createdAt,
    ) {}

    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getApellido(): string
    {
        return $this->apellido;
    }

    public function getRoleId(): int
    {
        return $this->roleId;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }
}
