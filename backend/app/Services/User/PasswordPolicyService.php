<?php

namespace App\Services\User;

/**
 * Valida que una contraseña cumpla con la política mínima de seguridad.
 */
final class PasswordPolicyService
{
    private const LONGITUD_MINIMA = 8;

    public static function esValida(string $password): bool
    {
        return strlen($password) >= self::LONGITUD_MINIMA;
    }
}
