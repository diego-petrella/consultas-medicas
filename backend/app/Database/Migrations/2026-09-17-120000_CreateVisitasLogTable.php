<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVisitasLogTable extends Migration
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
            'visita_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'usuario_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'accion' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'datos_anteriores' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'datos_nuevos' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('visita_id', 'visitas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('usuario_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('visitas_log');
    }

    public function down()
    {
        $this->forge->dropTable('visitas_log');
    }
}
