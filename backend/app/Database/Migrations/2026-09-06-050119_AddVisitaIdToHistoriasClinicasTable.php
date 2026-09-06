<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddVisitaIdToHistoriasClinicasTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('historias_clinicas', [
            'visita_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'doctor_id',
            ],
        ]);

        $this->forge->addForeignKey('visita_id', 'visitas', 'id', 'CASCADE', 'SET NULL');
        $this->forge->processIndexes('historias_clinicas');
    }

    public function down()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->dropForeignKey('historias_clinicas', 'historias_clinicas_visita_id_foreign');
        $this->forge->dropColumn('historias_clinicas', 'visita_id');
        $this->db->enableForeignKeyChecks();
    }
}
