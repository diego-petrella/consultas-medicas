<?php

namespace App\Services\User;

use App\Models\UserModel;
use Config\Database;
use Exception;

/**
 * Valida las credenciales de un usuario contra la base de datos.
 */
final class UserFinderService
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Busca el usuario por username y verifica la contraseña con password_verify().
     * Si el usuario no existe o la contraseña no coincide, lanza una Exception.
     *
     * @return array{id: int, username: string, nombre: string, apellido: string, role_id: int, rol_nombre: string}
     *
     * @throws Exception Si el usuario no existe o la contraseña no coincide.
     */
    public function validarCredenciales(string $username, string $password): array
    {
        $user = $this->userModel->buscarPorUsername($username);

        if ($user === null || !password_verify($password, $user->getPassword())) {
            throw new Exception('Usuario o contraseña incorrectos.');
        }

        $rol = Database::connect()
            ->query('SELECT nombre FROM roles WHERE id = ?', [$user->getRoleId()])
            ->getRow();

        return [
            'id'         => $user->getId(),
            'username'   => $user->getUsername(),
            'nombre'     => $user->getNombre(),
            'apellido'   => $user->getApellido(),
            'role_id'    => $user->getRoleId(),
            'rol_nombre' => $rol->nombre,
        ];
    }
}
