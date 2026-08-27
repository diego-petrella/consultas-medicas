<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateObrasSocialesTable extends Migration
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
            'nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('nombre');
        $this->forge->createTable('obras_sociales');
    }

    public function down()
    {
        $this->forge->dropTable('obras_sociales');
    }
}
