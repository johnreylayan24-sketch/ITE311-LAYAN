<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    protected $userModel;
    protected $db;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->db = \Config\Database::connect();
        helper(['form', 'url', 'security']);
    }

    // Show login form
    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            return $this->handleLogin();
        }
        return view('auth/login');
    }

    // Handle login POST (for route compatibility)
    public function handleLoginAttempt()
    {
        return $this->handleLogin();
    }

    // Handle login POST
    protected function handleLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user = $this->userModel->where('email', $email)->first();

        // Debug: Check if user exists
        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'User not found with email: ' . $email);
        }

        // Debug: Check password verification
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Password verification failed for user: ' . $user['name']);
        }

        // Set session
        $this->setUserSession($user);

        return $this->redirectToDashboard();
    }

    // Set simplified session
    protected function setUserSession($user)
    {
        session()->set([
            'isLoggedIn' => true,
            'user_id'    => $user['id'],
            'name'       => $user['name'],
            'email'      => $user['email'],
            'role'       => $user['role'], // admin / teacher / student
        ]);
    }

    // Redirect to dashboard based on role
    protected function redirectToDashboard()
    {
        $role = session()->get('role');

        return match($role) {
            'admin' => redirect()->to('/dashboard'),
            'teacher' => redirect()->to('/teacher/dashboard'),
            'student' => redirect()->to('/student/dashboard'),
            default => redirect()->to('/auth/login')->with('error', 'Invalid user role'),
        };
    }

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login')->with('success', 'Logged out successfully');
    }

    // Show registration form
    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'name' => 'required|min_length[3]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[8]',
                'password_confirm' => 'matches[password]'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $this->userModel->save([
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role' => 'student', // default role
            ]);

            return redirect()->to('/login')->with('success', 'Registration successful! Please login.');
        }

        return view('auth/register');
    }

    // Show dashboard
    public function dashboard()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Please login first');
        }

        $role = session()->get('role');
        $data = [
            'title' => ucfirst($role) . ' Dashboard',
            'user'  => [
                'id' => session()->get('user_id'),
                'name' => session()->get('name'),
                'role' => $role,
            ]
        ];

        // Example: admin stats
        if ($role === 'admin') {
            $data['stats'] = [
                'total_users' => $this->userModel->countAll(),
                'total_teachers' => $this->userModel->where('role', 'teacher')->countAllResults(),
                'total_students' => $this->userModel->where('role', 'student')->countAllResults(),
            ];
            $data['recent_users'] = $this->userModel->orderBy('created_at', 'DESC')->findAll(5);
        }

        return view('auth/dashboards/' . $role . '_dashboard', $data);
    }
}
