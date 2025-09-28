<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateCoursesTable extends Migration
{
    public function up()
    {
        $fields = [
            'teacher_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'after'      => 'id',
            ]
        ];
        
        $this->forge->addColumn('courses', $fields);
        
        // Drop the old instructor_id column if it exists
        if ($this->db->fieldExists('instructor_id', 'courses')) {
            $this->forge->dropColumn('courses', 'instructor_id');
        }
        
        // Add foreign key constraint
        $this->forge->addForeignKey('teacher_id', 'users', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        // Drop foreign key first
        $this->db->query("ALTER TABLE courses DROP FOREIGN KEY courses_teacher_id_foreign");
        
        // Drop teacher_id column
        $this->forge->dropColumn('courses', 'teacher_id');
        
        // Add back instructor_id column
        $fields = [
            'instructor_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'after'      => 'id',
            ]
        ];
        $this->forge->addColumn('courses', $fields);
    }
}
