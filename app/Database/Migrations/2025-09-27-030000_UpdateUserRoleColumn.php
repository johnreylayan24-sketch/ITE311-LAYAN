<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateUserRoleColumn extends Migration
{
    public function up()
    {
        // First, we need to drop the existing role column
        $this->forge->dropColumn('users', 'role');
        
        // Then add the role column back with the correct values
        $this->forge->addColumn('users', [
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['admin', 'teacher', 'student'],
                'default'    => 'student',
                'after'      => 'password'
            ]
        ]);
    }

    public function down()
    {
        // Drop the current role column
        $this->forge->dropColumn('users', 'role');
        
        // Add back the old role column with instructor
        $this->forge->addColumn('users', [
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['admin', 'instructor', 'student'],
                'default'    => 'student',
                'after'      => 'password'
            ]
        ]);
    }
}
