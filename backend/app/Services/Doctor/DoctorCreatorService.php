<?php

namespace App\Services\Doctor;

use App\Models\DoctorModel;
use App\Models\UserModel;
use Config\Database;
use Exception;

/**
 * Servicio encargado de la creación de un doctor con su usuario correspondiente.
 */
final class DoctorCreatorService
{
    private UserModel $userModel;
    private DoctorModel $doctorModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->doctorModel = new DoctorModel();
    }

    /**
     * @param array $data Requerido: username, password, nombre, apellido.
     *                    Opcional: matricula, especialidad, telefono.
     *
     * @return int ID del doctor creado en la tabla doctores.
     * @throws Exception Si falla la transacción o la inserción de registros.
     */
public function crear(array $data): int
{
    $db = Database::connect();
    $db->transStart();

    $userId = $this->userModel->insert([
        'username'   => $data['username'],
        'password'   => password_hash($data['password'], PASSWORD_BCRYPT),
        'nombre'     => $data['nombre'] ?? null,
        'apellido'   => $data['apellido'] ?? null,
        'role_id'    => 2,
        'created_at' => date('Y-m-d H:i:s'),
    ]);

    if (!$userId) {
        $db->transRollback();
        throw new Exception('No se pudo crear el usuario del doctor.');
    }

    $doctorId = $this->doctorModel->insert([
        'user_id'      => $userId,
        'matricula'    => $data['matricula'] ?? null,
        'especialidad' => $data['especialidad'] ?? null,
        'telefono'     => $data['telefono'] ?? null,
        'created_at'   => date('Y-m-d H:i:s'),
    ]);

    if (!$doctorId) {
        $db->transRollback();
        throw new Exception('No se pudo crear el perfil de doctor.');
    }

    $db->transComplete();

    if ($db->transStatus() === false) {
        throw new Exception('No se pudo completar la creación del doctor.');
    }

    return (int) $doctorId;
}
}