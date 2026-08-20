<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 1, 'nombre' => 'Administrativo'],
            ['id' => 2, 'nombre' => 'Colaborador'],
        ];

        $this->db->table('roles')->insertBatch($data);
    }
}
