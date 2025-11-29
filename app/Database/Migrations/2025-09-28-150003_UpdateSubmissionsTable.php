<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateSubmissionsTable extends Migration
{
    public function up()
    {
        $fields = [
            'assignment_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'quiz_id',
            ],
            'course_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'student_id',
            ]
        ];
        
        $this->forge->addColumn('submissions', $fields);
        
        // Add foreign key constraints
        $this->forge->addForeignKey('assignment_id', 'assignments', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('course_id', 'courses', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        // Drop foreign keys first
        $this->db->query("ALTER TABLE submissions DROP FOREIGN KEY submissions_assignment_id_foreign");
        $this->db->query("ALTER TABLE submissions DROP FOREIGN KEY submissions_course_id_foreign");
        
        // Drop columns
        $this->forge->dropColumn('submissions', 'assignment_id');
        $this->forge->dropColumn('submissions', 'course_id');
    }
}
