<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixRolesSeedData extends Migration
{
    public function up()
    {
        $this->db->query("UPDATE roles SET nombre = 'Doctor' WHERE nombre = 'Colaborador'");

        $paciente = $this->db->query("SELECT id FROM roles WHERE nombre = 'Paciente'")->getRow();

        if ($paciente === null) {
            $this->db->query("INSERT INTO roles (id, nombre) VALUES (3, 'Paciente')");
        }
    }

    public function down()
    {
        $this->db->query("DELETE FROM roles WHERE nombre = 'Paciente'");
        $this->db->query("UPDATE roles SET nombre = 'Colaborador' WHERE nombre = 'Doctor'");
    }
}
