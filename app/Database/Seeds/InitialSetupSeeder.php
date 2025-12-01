<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialSetupSeeder extends Seeder
{
    public function run()
    {
        // Rôles
        $roles = [
            [
                'name'       => 'Administrateur',
                'slug'       => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Utilisateur',
                'slug'       => 'user',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('roles')->insertBatch($roles);

        // Récupérer l'id du rôle admin
        $adminRole = $this->db->table('roles')->where('slug', 'admin')->get()->getRowArray();

        // User admin
        $this->db->table('users')->insert([
            'full_name'     => 'Admin LES3T',
            'email'         => 'admin@les3t.test',
            'password_hash' => password_hash('admin1234', PASSWORD_DEFAULT),
            'role_id'       => $adminRole['id'],
            'created_at'    => date('Y-m-d H:i:s'),
        ]);
    }
}
