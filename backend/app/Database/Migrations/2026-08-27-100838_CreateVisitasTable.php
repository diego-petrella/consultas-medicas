<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVisitasTable extends Migration
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
            'fecha' => [
                'type' => 'DATETIME',
                'null' => false,
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
            'obra_social_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'estado' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('paciente_id', 'pacientes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('doctor_id', 'doctores', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('obra_social_id', 'obras_sociales', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('visitas');
    }

    public function down()
    {
        $this->forge->dropTable('visitas');
    }
}
