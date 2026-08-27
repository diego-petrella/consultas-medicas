<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHistoriasClinicasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'paciente_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'doctor_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'fecha' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'diagnostico' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'tratamiento' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'observaciones' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('paciente_id', 'pacientes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('doctor_id', 'doctores', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('historias_clinicas');
    }

    public function down()
    {
        $this->forge->dropTable('historias_clinicas');
    }
}
