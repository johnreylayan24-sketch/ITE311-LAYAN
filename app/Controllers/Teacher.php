<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Teacher extends BaseController
{
    public function courses()
    {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Check if user is logged in and is a teacher
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'teacher') {
            return redirect()->to('/login')->with('error', 'Unauthorized access');
        }
        
        // Get database connection
        $db = \Config\Database::connect();
        
        // Get teacher's courses
        $teacherId = $_SESSION['user']['id'];
        $coursesQuery = $db->query("SELECT * FROM courses WHERE teacher_id = ?", [$teacherId]);
        $courses = $coursesQuery->getResult();
        
        // Get teacher info
        $teacherInfo = $_SESSION['user'];
        
        // Pass data to view
        $data = [
            'teacher' => $teacherInfo,
            'courses' => $courses,
            'page_title' => 'Teacher Courses'
        ];
        
        return view('teacher/courses', $data);
    }
    
    public function assignments()
    {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Check if user is logged in and is a teacher
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'teacher') {
            return redirect()->to('/login')->with('error', 'Unauthorized access');
        }
        
        // Get database connection
        $db = \Config\Database::connect();
        
        // Get teacher's assignments
        $teacherId = $_SESSION['user']['id'];
        $assignmentsQuery = $db->query("
            SELECT a.*, c.course_name 
            FROM assignments a 
            JOIN courses c ON a.course_id = c.id 
            WHERE c.teacher_id = ?", [$teacherId]);
        $assignments = $assignmentsQuery->getResult();
        
        // Pass data to view
        $data = [
            'teacher' => $_SESSION['user'],
            'assignments' => $assignments,
            'page_title' => 'Teacher Assignments'
        ];
        
        return view('teacher/assignments', $data);
    }
    
    public function grades()
    {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Check if user is logged in and is a teacher
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'teacher') {
            return redirect()->to('/login')->with('error', 'Unauthorized access');
        }
        
        // Get database connection
        $db = \Config\Database::connect();
        
        // Get teacher's grades data
        $teacherId = $_SESSION['user']['id'];
        $gradesQuery = $db->query("
            SELECT g.*, s.username as student_name, c.course_name, a.assignment_title
            FROM grades g
            JOIN students s ON g.student_id = s.id
            JOIN courses c ON g.course_id = c.id
            JOIN assignments a ON g.assignment_id = a.id
            WHERE c.teacher_id = ?", [$teacherId]);
        $grades = $gradesQuery->getResult();
        
        // Pass data to view
        $data = [
            'teacher' => $_SESSION['user'],
            'grades' => $grades,
            'page_title' => 'Teacher Grades'
        ];
        
        return view('teacher/grades', $data);
    }
    
    public function students()
    {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Check if user is logged in and is a teacher
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'teacher') {
            return redirect()->to('/login')->with('error', 'Unauthorized access');
        }
        
        // Get database connection
        $db = \Config\Database::connect();
        
        // Get teacher's students
        $teacherId = $_SESSION['user']['id'];
        $studentsQuery = $db->query("
            SELECT DISTINCT s.*, c.course_name
            FROM students s
            JOIN enrollments e ON s.id = e.student_id
            JOIN courses c ON e.course_id = c.id
            WHERE c.teacher_id = ?", [$teacherId]);
        $students = $studentsQuery->getResult();
        
        // Pass data to view
        $data = [
            'teacher' => $_SESSION['user'],
            'students' => $students,
            'page_title' => 'Teacher Students'
        ];
        
        return view('teacher/students', $data);
    }
}
