<?php

namespace App\Controllers\Student;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Student Dashboard',
            'user' => [
                'name' => session()->get('user_name'),
                'email' => session()->get('user_email'),
                'role' => session()->get('user_role')
            ]
        ];

        return view('student/dashboard', $data);
    }
}
