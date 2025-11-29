<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['form', 'url', 'security']);
    }

    public function showVerifyEmail()
    {
        // If user is not logged in, redirect to login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login')
                ->with('error', 'Please login to verify your email.');
        }

        // Redirect to dashboard
        return $this->redirectToDashboard();
    }

    public function login()
    {
        // Show login view with CSRF field
        $data = [
            'validation' => \Config\Services::validation(),
            'title' => 'Login'
        ];
        return view('auth/login', $data);
    }

    public function attemptLogin()
    {
        // Add CSRF protection
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]',
        ]);

        // Check login attempts using session-based throttling
        $throttleKey = 'login_attempts';
        $maxAttempts = 5;
        $lockoutTime = 60; // 1 minute in seconds
        
        // Initialize or increment login attempts
        $loginAttempts = session()->get($throttleKey) ?? 0;
        $lastAttempt = session()->get('login_attempt_time');
        
        // Reset attempts if the lockout time has passed
        ($lastAttempt && (time() - $lastAttempt > $lockoutTime)) && $loginAttempts = 0;
        
        // Check if user is locked out
        if ($loginAttempts >= $maxAttempts) {
            $remainingTime = $lockoutTime - (time() - $lastAttempt);
            if ($remainingTime > 0) {
                return redirect()->back()->withInput()
                    ->with('error', 'Too many login attempts. Please try again in ' . $remainingTime . ' seconds.');
            }
            // Reset attempts if lockout time has passed
            $loginAttempts = 0;
        }

        if ($validation->withRequest($this->request)->run()) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $user = $this->userModel->where('email', $email)->first();

            if ($user && password_verify($password, $user['password'])) {
                // Reset login attempts on successful login
                session()->remove('login_attempts');
                session()->remove('login_attempt_time');
                
                // Set session
                $this->setUserSession($user);
                return $this->redirectToDashboard();
            }
        }

        // Increment failed login attempts
        session()->set([
            'login_attempts' => $loginAttempts + 1,
            'login_attempt_time' => time()
        ]);
        return redirect()->back()
            ->with('error', 'Invalid email or password')
            ->withInput()
            ->with('errors', $validation->getErrors());
    }

    protected function setUserSession($user)
    {
        $data = [
            'user_id'    => $user['id'],
            'user_name'  => $user['name'],
            'user_email' => $user['email'],
            'user_role'  => $user['role'],
            'isLoggedIn' => true
        ];
        session()->set($data);
        return true;
    }

    public function dashboard()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Please login first');
        }

        $data = [
            'title' => 'Dashboard',
            'user' => [
                'name' => session()->get('user_name'),
                'email' => session()->get('user_email'),
                'role' => session()->get('user_role')
            ]
        ];

        // Add role-specific data
        $userRole = session()->get('user_role');
        switch ($userRole) {
            case 'admin':
                $data['stats'] = [
                    'total_users' => $this->userModel->countAll(),
                    'total_teachers' => $this->userModel->where('role', 'teacher')->countAllResults(),
                    'total_students' => $this->userModel->where('role', 'student')->countAllResults()
                ];
                $data['recent_users'] = $this->userModel->orderBy('created_at', 'DESC')->findAll(5);
                break;
                
            case 'teacher':
                // Add teacher-specific data
                $data['courses'] = []; // Add actual course data from your model
                $data['upcoming_classes'] = []; // Add upcoming classes
                break;
                
            case 'student':
                // Add student-specific data
                $data['enrolled_courses'] = []; // Add actual enrolled courses data
                $data['upcoming_deadlines'] = []; // Add upcoming deadlines
                break;
        }

        // Load the appropriate view based on role
        return view('auth/dashboards/' . $userRole . '_dashboard', $data);
    }

    protected function redirectToDashboard()
    {
        // Ensure session is started
        $session = session();
        
        // Debug: Log the session data
        log_message('debug', 'Session data: ' . print_r($session->get(), true));
        
        // Get the user role from session
        $role = $session->get('user_role');
        
        if (empty($role)) {
            log_message('error', 'No user role found in session');
            return redirect()->to('/login')->with('error', 'Session expired. Please login again.');
        }
        
        // Set default redirect URL
        $redirectUrl = '/dashboard';
        
        // Map roles to their respective dashboards
        $roleMap = [
            'admin'   => '/admin/dashboard',
            'teacher' => '/teacher/dashboard',
            'student' => '/student/dashboard'
        ];
        
        // Get the appropriate dashboard URL based on role
        $redirectUrl = $roleMap[strtolower($role)] ?? '/dashboard';
        
        log_message('debug', "Redirecting user with role '{$role}' to: {$redirectUrl}");
        
        return redirect()->to($redirectUrl);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('message', 'You have been logged out.');
    }

    // Add registration method if needed
    public function register()
    {
        // Check if registration is allowed (you can add this to config)
        if (!config('App')->allowRegistration) {
            return redirect()->back()->with('error', 'Registration is currently disabled.');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required|min_length[3]|max_length[50]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]|strong_password',
            'password_confirm' => 'matches[password]',
            'role' => 'required|in_list[student,teacher]' // Only allow student/teacher registration
        ]);

        if ($this->request->getMethod() === 'post' && $validation->withRequest($this->request)->run()) {
            // Save user
            $userData = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role' => $this->request->getPost('role')
            ];

            $this->userModel->save($userData);
            
            // Send verification email (you'll need to implement this)
            // $this->sendVerificationEmail($userData['email']);
            
            return redirect()->to('/login')->with('success', 'Registration successful! Please login.');
        }

        $data = [
            'validation' => $validation,
            'title' => 'Register'
        ];
        return view('auth/register', $data);
    }

    // Add this method to your Auth controller
    protected function checkAccess($allowedRoles = [])
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Please login first');
        }

        $userRole = session()->get('user_role');
        
        if (!empty($allowedRoles) && !in_array($userRole, $allowedRoles)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('You do not have permission to access this page');
        }
        
        return true;
    }
}