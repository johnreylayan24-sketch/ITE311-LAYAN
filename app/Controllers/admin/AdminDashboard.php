<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AdminDashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Admin Dashboard',
            'user' => session()->get(),
        ];

        return view('auth/dashboards/admin_dashboard', $data);
    }
}
