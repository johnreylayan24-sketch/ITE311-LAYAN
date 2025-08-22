<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            // Admin user
            [
                'email' => 'layan@lms.edu',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'first_name' => 'System',
                'last_name' => 'Admin',
                'role' => 'admin',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            // Instructor users
            [
                'email' => 'sir jim@lms.edu',
                'password' => password_hash('instructor123', PASSWORD_DEFAULT),
                'first_name' => 'Jim',
                'last_name' => 'Jamero',
                'role' => 'instructor',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'email' => 'Sir Erick@lms.edu',
                'password' => password_hash('instructor123', PASSWORD_DEFAULT),
                'first_name' => 'Erick',
                'last_name' => 'Ric',
                'role' => 'instructor',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            // Student users
            [
                'email' => 'Xyrl@lms.edu',
                'password' => password_hash('student123', PASSWORD_DEFAULT),
                'first_name' => 'Racaza',
                'last_name' => 'xyrl',
                'role' => 'student',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'email' => 'jerald@lms.edu',
                'password' => password_hash('student123', PASSWORD_DEFAULT),
                'first_name' => 'MACA',
                'last_name' => 'JERALD',
                'role' => 'student',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'email' => 'Gomez@lms.edu',
                'password' => password_hash('student123', PASSWORD_DEFAULT),
                'first_name' => 'Mirai',
                'last_name' => 'gomez',
                'role' => 'student',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
        ];

        $this->db->table('users')->insertBatch($users);
        
        echo "Successfully seeded users table.\n";
        $data = [
            [
                'name'     => 'Layan, Johnrey',
                'email'    => 'johnreylayan@gmail.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role'     => 'admin'
            ],
            [
                'name'     => 'Jim Jamero',
                'email'    => 'Jamero@gmail.com',
                'password' => password_hash('instructor123', PASSWORD_DEFAULT),
                'role'     => 'instructor'
            ],
            [
                'name'     => 'Xyrl Racaza',
                'email'    => 'Racaza@gmail.com',
                'password' => password_hash('student123', PASSWORD_DEFAULT),
                'role'     => 'student'
            ],
            [
                'name'     => 'Crisandy Gomez',
                'email'    => 'Crisandy@gmail.com',
                'password' => password_hash('student123', PASSWORD_DEFAULT),
                'role'     => 'student'
            ],
        ];

        // Insert all data in one go
        $this->db->table('users')->insertBatch($data);    }
}
