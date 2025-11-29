<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('user_role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'You do not have permission to access the admin area.');
        }

        $data = [
            'title' => 'Admin Dashboard',
            'user' => [
                'name' => session()->get('user_name'),
                'email' => session()->get('user_email'),
                'role' => session()->get('user_role')
            ]
        ];

        return view('admin/dashboard', $data);
    }
}
