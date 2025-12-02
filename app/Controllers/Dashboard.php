<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function publicIndex()
    {
        // Clear any existing session data to ensure clean login state
        if (session()->get('isLoggedIn')) {
            session()->destroy();
        }
        
        // Show public dashboard with login prompt
        return view('dashboard/public');
    }

    public function test()
    {
        return "Dashboard controller is working!";
    }

    public function index()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login')
                ->with('error', 'Please login first');
        }

        $role = strtolower(session()->get('role'));
        
        // Basic data structure that the dashboard view expects
        $data = [
            'title' => ucfirst($role) . ' Dashboard',
            'user' => [
                'id' => session()->get('user_id'),
                'name' => session()->get('name'),
                'role' => $role,
                'email' => session()->get('email') ?? 'user@example.com'
            ]
        ];

        // Add role-specific features
        if ($role === 'admin') {
            $data['admin_features'] = [
                'total_users' => 1,
                'recent_activities' => [
                    ['action' => 'System running', 'time' => 'Just now']
                ]
            ];
        } elseif ($role === 'teacher') {
            $data['teacher_features'] = [
                'my_courses' => [],
                'pending_submissions' => 0
            ];
        } elseif ($role === 'student') {
            $data['student_features'] = [
                'my_courses' => [],
                'recent_grades' => []
            ];
        }

        // Load the dashboard view
        return view('dashboard', $data);
    }
}
