<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddActivoToDoctoresTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('doctores', [
            'activo' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
                'after'      => 'telefono',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('doctores', 'activo');
    }
}
