<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Empty enrollments first (to avoid FK error)
        $this->db->table('enrollments')->emptyTable();

        // Empty users next
        $this->db->table('users')->emptyTable();

        $data = [
            [
                'email'      => 'racazaxyrl@example.com',
                'password'   => password_hash('admin123', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'email'      => 'layan@example.com',
                'password'   => password_hash('student123', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'email'      => 'maranan@example.com',
                'password'   => password_hash('student123', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'email'      => 'jimjamero@example.com',
                'password'   => password_hash('instructor123', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
