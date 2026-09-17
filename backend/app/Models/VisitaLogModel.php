<?php

namespace App\Models;

use CodeIgniter\Database\BaseConnection;
use Config\Database;

final class VisitaLogModel
{
    private BaseConnection $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function registrar(int $visitaId, int $usuarioId, string $accion, ?array $datosAnteriores, ?array $datosNuevos): void
    {
        $this->db->query(
            'INSERT INTO visitas_log (visita_id, usuario_id, accion, datos_anteriores, datos_nuevos, created_at) VALUES (?, ?, ?, ?, ?, ?)',
            [
                $visitaId,
                $usuarioId,
                $accion,
                $datosAnteriores !== null ? json_encode($datosAnteriores) : null,
                $datosNuevos !== null ? json_encode($datosNuevos) : null,
                date('Y-m-d H:i:s'),
            ]
        );
    }

    public function obtenerPorVisita(int $visitaId): array
    {
        $result = $this->db->query(
            'SELECT * FROM visitas_log WHERE visita_id = ? ORDER BY created_at DESC, id DESC',
            [$visitaId]
        );

        return $result->getResultArray();
    }
}
