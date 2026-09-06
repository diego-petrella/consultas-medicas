<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTelefonoToPacientesTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pacientes', [
            'telefono' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
                'after'      => 'fecha_nacimiento',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pacientes', 'telefono');
    }
}
