<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name' => 'Administrator',
            'email' => 'admin@lms.test',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'role' => 'admin',
            'email_verified' => 1,
            'created_at' => Time::now(),
            'updated_at' => Time::now()
        ];

        $this->db->table('users')->insert($data);
    }
}
