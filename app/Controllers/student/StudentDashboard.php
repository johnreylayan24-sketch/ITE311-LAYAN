<?php

namespace App\Controllers\Student;

use App\Controllers\BaseController;

class StudentDashboard extends BaseController
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login')
                ->with('error', 'Please login first');
        }

        // Check if user is student
        if (session()->get('role') !== 'student') {
            return redirect()->to('/dashboard')->with('error', 'Access denied');
        }

        $data = [
            'title' => 'Student Dashboard',
            'user' => [
                'id' => session()->get('user_id'),
                'name' => session()->get('name'),
                'role' => 'student',
                'email' => session()->get('email') ?? 'student@example.com'
            ],
            'student_features' => [
                'my_courses' => [
                    ['name' => 'Mathematics 101', 'progress' => 85],
                    ['name' => 'Physics 201', 'progress' => 70]
                ],
                'recent_grades' => [
                    ['assignment' => 'Quiz 1', 'grade' => 92],
                    ['assignment' => 'Homework 2', 'grade' => 88]
                ]
            ]
        ];

        return view('student_dashboard', $data);
    }
}
