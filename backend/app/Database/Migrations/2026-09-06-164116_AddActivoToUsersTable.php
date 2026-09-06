<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddActivoToUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'activo' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
                'after'      => 'role_id',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'activo');
    }
}
