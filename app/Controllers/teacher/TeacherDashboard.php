<?php

namespace App\Controllers\Teacher;

use App\Controllers\BaseController;

class TeacherDashboard extends BaseController
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login')
                ->with('error', 'Please login first');
        }

        // Check if user is teacher
        if (session()->get('role') !== 'teacher') {
            return redirect()->to('/dashboard')->with('error', 'Access denied');
        }

        $data = [
            'title' => 'Teacher Dashboard',
            'user' => [
                'id' => session()->get('user_id'),
                'name' => session()->get('name'),
                'role' => 'teacher',
                'email' => session()->get('email') ?? 'teacher@example.com'
            ],
            'teacher_features' => [
                'my_courses' => [
                    ['name' => 'Mathematics 101', 'students' => 25, 'progress' => 75],
                    ['name' => 'Physics 201', 'students' => 20, 'progress' => 60]
                ],
                'pending_submissions' => 5
            ]
        ];

        return view('teacher_dashboard', $data);
    }
}
