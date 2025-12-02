<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['title', 'description', 'instructor_id', 'status'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    /**
     * Get all active courses
     */
    public function getActiveCourses()
    {
        return $this->where('status', 'active')->findAll();
    }
    
    /**
     * Get courses by instructor
     */
    public function getInstructorCourses($instructorId)
    {
        return $this->where('instructor_id', $instructorId)
                   ->findAll();
    }
    
    /**
     * Get course with enrolled students
     */
    public function getCourseWithStudents($courseId)
    {
        $db = \Config\Database::connect();
        return $db->table('enrollments')
                 ->select('enrollments.*, users.name as student_name, users.email as student_email')
                 ->join('users', 'users.id = enrollments.user_id')
                 ->where('enrollments.course_id', $courseId)
                 ->get()
                 ->getResultArray();
    }
    
    /**
     * Enroll a student in a course
     */
    public function enrollStudent($courseId, $userId)
    {
        $enrollmentModel = new \App\Models\EnrollmentModel();
        
        // Check if already enrolled
        if ($enrollmentModel->where('user_id', $userId)
                          ->where('course_id', $courseId)
                          ->countAllResults() > 0) {
            return false; // Already enrolled
        }
        
        $data = [
            'course_id' => $courseId,
            'user_id' => $userId,
            'enrolled_at' => date('Y-m-d H:i:s'),
            'status' => 'enrolled'
        ];
        
        return $enrollmentModel->insert($data);
    }
    
    /**
     * Get course details by ID
     */
    public function getCourseDetails($courseId)
    {
        return $this->find($courseId);
    }
}
