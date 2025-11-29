<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
<<<<<<< HEAD
        // Simple user data
        $users = [
            [
                'name'     => 'Admin',
                'email'    => 'admin@gmail.com',
=======
        $data = [
            [
                'name' => 'LAYANZZ',
                'email' => 'LAYANJOHNRY@gmail.com',
>>>>>>> 9bc49831b38c627ac5b7e400f2b51d63a4e97daf
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 'admin',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
<<<<<<< HEAD
                'name'     => 'Teacher',
                'email'    => 'teacher@gmail.com',
                'password' => password_hash('teacher123', PASSWORD_DEFAULT),
                'role'     => 'teacher'
            ],
            [
                'name'     => 'Student',
                'email'    => 'student@gmail.com',
                'password' => password_hash('student123', PASSWORD_DEFAULT),
                'role'     => 'student'
            ]
        ];

        // Get database connection
        $db = \Config\Database::connect();
        
        // Insert each user
        foreach ($users as $user) {
            // Add timestamps
            $user['created_at'] = date('Y-m-d H:i:s');
            $user['updated_at'] = date('Y-m-d H:i:s');
            
            // Check if user exists
            $exists = $db->table('users')
                       ->where('email', $user['email'])
                       ->countAllResults() > 0;
            
            if (!$exists) {
                $db->table('users')->insert($user);
                echo "User added: " . $user['email'] . "\n";
            } else {
                echo "User exists: " . $user['email'] . "\n";
            }
        }
        
        echo "\nSeeding complete!\n";
        echo "Admin: admin@example.com / admin123\n";
        echo "Teacher: teacher@example.com / teacher123\n";
        echo "Student: student@example.com / student123\n\n";
=======
                'name' => 'XYRL RACAZA',
                'email' => 'RACAZA@gmail.com',
                'password' => password_hash('2311600073', PASSWORD_DEFAULT),
                'role' => 'student',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        // Insert multiple records
        $this->db->table('users')->insertBatch($data);
>>>>>>> 9bc49831b38c627ac5b7e400f2b51d63a4e97daf
    }
}
