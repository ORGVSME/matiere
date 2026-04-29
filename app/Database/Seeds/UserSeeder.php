<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'matricule' => 'USR-0041',
                'name' => 'Andry Rakoto',
                'email' => 'andry.rakoto@si.mg',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'Administrateur',
                'department' => 'DSI',
                'status' => 'Actif',
                'last_login' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'matricule' => 'USR-0042',
                'name' => 'Fanja Razafy',
                'email' => 'fanja.razafy@si.mg',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'Gestionnaire',
                'department' => 'Finance',
                'status' => 'Actif',
                'last_login' => date('Y-m-d H:i:s', strtotime('-2 day')),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'matricule' => 'USR-0043',
                'name' => 'Hery Ranaivo',
                'email' => 'hery.ranaivo@si.mg',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'Auditeur',
                'department' => 'RH',
                'status' => 'Inactif',
                'last_login' => date('Y-m-d H:i:s', strtotime('-10 day')),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'matricule' => 'USR-0044',
                'name' => 'Lalao Rabenja',
                'email' => 'lalao.rabenja@si.mg',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'Opérateur',
                'department' => 'Commercial',
                'status' => 'Actif',
                'last_login' => date('Y-m-d H:i:s', strtotime('-30 minutes')),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'matricule' => 'USR-0045',
                'name' => 'Miora Tsarafidy',
                'email' => 'miora.tsarafidy@si.mg',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'Gestionnaire',
                'department' => 'DSI',
                'status' => 'Suspendu',
                'last_login' => null,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'matricule' => 'USR-0046',
                'name' => 'Rodin Nomenjanahary',
                'email' => 'rodin.n@si.mg',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'Administrateur',
                'department' => 'DSI',
                'status' => 'Actif',
                'last_login' => date('Y-m-d H:i:s', strtotime('-5 minutes')),
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
