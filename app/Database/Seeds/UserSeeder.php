<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // User data with both admin and test accounts
        $users = [
            [
                'name' => 'LAYANZZ Admin',
                'email' => 'Johnreylayan@gmail.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Teacher',
                'email' => 'teacher@gmail.com',
                'password' => password_hash('teacher123', PASSWORD_DEFAULT),
                'role' => 'teacher',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Student',
                'email' => 'student@gmail.com',
                'password' => password_hash('student123', PASSWORD_DEFAULT),
                'role' => 'student',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        // Get database connection
        $db = \Config\Database::connect();
        
        // Insert each user
        foreach ($users as $user) {
            // Check if user already exists
            $exists = $db->table('users')
                       ->where('email', $user['email'])
                       ->countAllResults();
            
            if (!$exists) {
                $db->table('users')->insert($user);
            }
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
        
        // Add additional test users
        $additionalUsers = [
            [
                'name' => 'XYRL RACAZA',
                'email' => 'RACAZA@gmail.com',
                'password' => password_hash('2311600073', PASSWORD_DEFAULT),
                'role' => 'student',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        
        // Insert additional users
        foreach ($additionalUsers as $user) {
            $exists = $db->table('users')
                       ->where('email', $user['email'])
                       ->countAllResults() > 0;
            
            if (!$exists) {
                $db->table('users')->insert($user);
                echo "Additional user added: " . $user['email'] . "\n";
            } else {
                echo "Additional user exists: " . $user['email'] . "\n";
            }
        }
        
        echo "\nSeeding complete!\n";
        echo "Admin: LAYANJOHNRY@gmail.com / admin123\n";
        echo "Admin: admin@gmail.com / admin123\n";
        echo "Teacher: teacher@gmail.com / teacher123\n";
        echo "Student: student@gmail.com / student123\n";
        echo "Student: RACAZA@gmail.com / 2311600073\n\n";
    }
}
