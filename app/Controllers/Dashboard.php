<?php

namespace App\Controllers;

use App\Models\EnrollmentModel;
use App\Models\CourseModel;
use CodeIgniter\Controller;

class Dashboard extends Controller
{
    protected $enrollmentModel;
    protected $courseModel;
    protected $session;

    public function __construct()
    {
        $this->enrollmentModel = new EnrollmentModel();
        $this->courseModel = new CourseModel();
        $this->session = session();
    }

    // Default dashboard (redirect by role)
    public function index()
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'You must log in first.');
        }

        $role = $this->session->get('user_role');
        return redirect()->to("/dashboard/{$role}");
    }

    // Admin dashboard
    public function admin()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('user_role') !== 'admin') {
            return redirect()->to('/auth/login')->with('error', 'You must log in as an administrator.');
        }

        return view('dashboard/admin', [
            'title' => 'Admin Dashboard',
            'user_name' => $this->session->get('user_name'),
            'user_role' => $this->session->get('user_role')
        ]);
    }

    // Teacher dashboard
    public function teacher()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('user_role') !== 'teacher') {
            return redirect()->to('/auth/login')->with('error', 'You must log in as a teacher.');
        }

        return view('dashboard/teacher', [
            'title' => 'Teacher Dashboard',
            'user_name' => $this->session->get('user_name'),
            'user_role' => $this->session->get('user_role')
        ]);
    }

    // Student dashboard
    public function student()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('user_role') !== 'student') {
            return redirect()->to('/auth/login')->with('error', 'You must log in as a student.');
        }

        $user_id = $this->session->get('user_id');
        $enrollments = $this->enrollmentModel->where('student_id', $user_id)->findAll();
        $courses = $this->courseModel->findAll();

        return view('dashboard/student', [
            'title' => 'Student Dashboard',
            'user_name' => $this->session->get('user_name'),
            'user_role' => $this->session->get('user_role'),
            'enrollments' => $enrollments,
            'courses' => $courses
        ]);
    }
}
