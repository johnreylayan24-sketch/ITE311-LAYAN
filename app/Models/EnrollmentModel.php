<?php

namespace App\Models;

use CodeIgniter\Model;

class EnrollmentModel extends Model
{
    protected $table = 'enrollments';
    protected $allowedFields = ['user_id', 'course_id', 'created_at'];
    protected $useTimestamps = true;

    // Insert a new enrollment
    public function enrollUser($user_id, $course_id)
    {
        return $this->insert([
            'user_id' => $user_id,
            'course_id' => $course_id
        ]);
    }

    // Fetch enrolled courses of a user
    public function getUserEnrollments($user_id)
    {
        // Alias course ID to 'course_id' for clarity
        return $this->select('courses.id as course_id, courses.title, courses.description')
                    ->join('courses', 'courses.id = enrollments.course_id')
                    ->where('enrollments.user_id', $user_id)
                    ->findAll();
    }

    // Check if user already enrolled
    public function isAlreadyEnrolled($user_id, $course_id)
    {
        return $this->where(['user_id' => $user_id, 'course_id' => $course_id])
                    ->first() ? true : false;
    }
}
