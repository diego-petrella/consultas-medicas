<?php

namespace App\Controllers\Stats;

use App\Controllers\BaseController;
use CodeIgniter\Database\BaseConnection;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Database;

final class StatsController extends BaseController
{
    private BaseConnection $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function dashboard(): ResponseInterface
    {
        $data = [
            'totalPacientesActivos'   => $this->totalPacientesActivos(),
            'visitasEsteMes'          => $this->visitasEsteMes(),
            'visitasPorMes'           => $this->visitasPorMes(),
            'visitasPorObraSocial'    => $this->visitasPorObraSocial(),
            'visitasPorDoctor'        => $this->visitasPorDoctor(),
            'pacientesNuevosEsteMes'  => $this->pacientesNuevosEsteMes(),
        ];

        return $this->response->setJSON($data);
    }

    // TODO: filtrar por pacientes.activo = 1 cuando esa columna exista en pacientes.
    private function totalPacientesActivos(): int
    {
        $result = $this->db->query('SELECT COUNT(*) as total FROM pacientes');

        return (int) $result->getRow()->total;
    }

    private function visitasEsteMes(): int
    {
        $result = $this->db->query(
            'SELECT COUNT(*) as total FROM visitas
             WHERE estado = 1
               AND YEAR(fecha) = YEAR(CURDATE())
               AND MONTH(fecha) = MONTH(CURDATE())'
        );

        return (int) $result->getRow()->total;
    }

    private function visitasPorMes(): array
    {
        $result = $this->db->query(
            "SELECT DATE_FORMAT(fecha, '%Y-%m') as mes, COUNT(*) as cantidad
             FROM visitas
             WHERE estado = 1
             GROUP BY YEAR(fecha), MONTH(fecha)
             ORDER BY YEAR(fecha) DESC, MONTH(fecha) DESC
             LIMIT 6"
        );

        $filas = [];
        foreach ($result->getResult() as $fila) {
            $filas[] = [
                'mes'      => $fila->mes,
                'cantidad' => (int) $fila->cantidad,
            ];
        }

        return $filas;
    }

    private function visitasPorObraSocial(): array
    {
        $result = $this->db->query(
            "SELECT COALESCE(obras_sociales.nombre, 'Sin obra social') as obraSocial,
                    COUNT(*) as cantidad
             FROM visitas
             LEFT JOIN obras_sociales ON obras_sociales.id = visitas.obra_social_id
             WHERE visitas.estado = 1
             GROUP BY visitas.obra_social_id, obras_sociales.nombre
             ORDER BY cantidad DESC"
        );

        $filas = [];
        foreach ($result->getResult() as $fila) {
            $filas[] = [
                'obraSocial' => $fila->obraSocial,
                'cantidad'   => (int) $fila->cantidad,
            ];
        }

        return $filas;
    }

    private function visitasPorDoctor(): array
    {
        $result = $this->db->query(
            "SELECT users.nombre as doctorNombre,
                    users.apellido as doctorApellido,
                    COUNT(*) as cantidad
             FROM visitas
             JOIN doctores ON doctores.id = visitas.doctor_id
             JOIN users ON users.id = doctores.user_id
             WHERE visitas.estado = 1
             GROUP BY visitas.doctor_id, users.nombre, users.apellido
             ORDER BY cantidad DESC"
        );

        $filas = [];
        foreach ($result->getResult() as $fila) {
            $filas[] = [
                'doctorNombre'   => $fila->doctorNombre,
                'doctorApellido' => $fila->doctorApellido,
                'cantidad'       => (int) $fila->cantidad,
            ];
        }

        return $filas;
    }

    private function pacientesNuevosEsteMes(): int
    {
        $result = $this->db->query(
            'SELECT COUNT(*) as total FROM pacientes
             WHERE YEAR(created_at) = YEAR(CURDATE())
               AND MONTH(created_at) = MONTH(CURDATE())'
        );

        return (int) $result->getRow()->total;
    }
}
