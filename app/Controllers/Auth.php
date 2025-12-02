<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    protected $userModel;
    protected $db;
    protected $maxLoginAttempts = 5;
    protected $lockoutTime = 900; // 15 minutes

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->db = \Config\Database::connect();
        helper(['form', 'url', 'security']);
    }

    // Show login form
    public function login()
    {
        // Check if user is locked out
        if ($this->isUserLockedOut()) {
            return redirect()->to('/auth/login')->with('error', 'Too many failed attempts. Please try again in 15 minutes.');
        }

        if ($this->request->getMethod() === 'post') {
            return $this->handleLogin();
        }
        return view('auth/login');
    }

    // Check if user is locked out
    protected function isUserLockedOut()
    {
        $email = $this->request->getPost('email');
        $attempts = session()->get('login_attempts_' . md5($email));
        
        if ($attempts && $attempts['count'] >= $this->maxLoginAttempts) {
            $lockoutTime = session()->get('login_lockout_' . md5($email));
            if ($lockoutTime && time() < $lockoutTime) {
                return true;
            }
        }
        return false;
    }

    // Increment login attempts
    protected function incrementLoginAttempts($email)
    {
        $emailHash = md5($email);
        $attempts = session()->get('login_attempts_' . $emailHash);
        
        if (!$attempts) {
            session()->set('login_attempts_' . $emailHash, ['count' => 1, 'first_attempt' => time()]);
        } else {
            $attempts['count']++;
            session()->set('login_attempts_' . $emailHash, $attempts);
        }

        // Lock user if max attempts reached
        if ($attempts['count'] >= $this->maxLoginAttempts) {
            session()->set('login_lockout_' . $emailHash, time() + $this->lockoutTime);
        }
    }

    // Clear login attempts
    protected function clearLoginAttempts($email)
    {
        session()->remove('login_attempts_' . md5($email));
        session()->remove('login_lockout_' . md5($email));
    }

    // Handle login POST (for route compatibility)
    public function handleLoginAttempt()
    {
        return $this->handleLogin();
    }

    // Handle login POST
    protected function handleLogin()
    {
        // Get and sanitize input
        $email = $this->sanitizeInput($this->request->getPost('email'));
        $password = $this->request->getPost('password');

        // Enhanced validation
        $rules = [
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|max_length[255]',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Please enter a valid email address',
                    'max_length' => 'Email address is too long'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|max_length[255]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must be at least 8 characters long',
                    'max_length' => 'Password is too long'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Rate limiting check
        if ($this->isUserLockedOut()) {
            return redirect()->to('/auth/login')->with('error', 'Too many failed attempts. Please try again in 15 minutes.');
        }

        // Find user using Query Builder (SQL injection prevention)
        $user = $this->userModel->where('email', $email)->first();

        // Generic error message for security
        if (!$user || !password_verify($password, $user['password'])) {
            $this->incrementLoginAttempts($email);
            return redirect()->back()->withInput()->with('error', 'Invalid email or password');
        }

        // Check if account is active (you can add a status field)
        if (isset($user['status']) && $user['status'] !== 'active') {
            return redirect()->back()->withInput()->with('error', 'Account is not active');
        }

        // Clear login attempts on successful login
        $this->clearLoginAttempts($email);

        // Regenerate session ID to prevent session fixation
        session()->regenerate(true);

        // Set session with security measures
        $this->setUserSession($user);

        // Log successful login (for security monitoring)
        $this->logSecurityEvent('login_success', $user['id'], $email);

        return $this->redirectToDashboard();
    }

    // Sanitize input data
    protected function sanitizeInput($input)
    {
        if (is_string($input)) {
            return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
        }
        return $input;
    }

    // Log security events
    protected function logSecurityEvent($event, $userId, $email = null)
    {
        $logData = [
            'event' => $event,
            'user_id' => $userId,
            'email' => $email,
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent(),
            'timestamp' => date('Y-m-d H:i:s')
        ];
        
        // You can store this in database or file
        log_message('info', 'Security Event: ' . json_encode($logData));
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
        $userId = session()->get('user_id');
        $email = session()->get('email');
        
        // Log logout event
        if ($userId) {
            $this->logSecurityEvent('logout', $userId, $email);
        }
        
        // Destroy session completely
        session()->destroy();
        
        return redirect()->to('/auth/login')->with('success', 'Logged out successfully');
    }

    // Show registration form
    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            return $this->handleRegistration();
        }
        return view('auth/register');
    }

    // Handle registration
    protected function handleRegistration()
    {
        // Get and sanitize inputs
        $name = $this->sanitizeInput($this->request->getPost('name'));
        $email = $this->sanitizeInput($this->request->getPost('email'));
        $password = $this->request->getPost('password');
        $password_confirm = $this->request->getPost('password_confirm');

        // Enhanced validation rules
        $rules = [
            'name' => [
                'label' => 'Full Name',
                'rules' => 'required|min_length[3]|max_length[100]|alpha_space',
                'errors' => [
                    'required' => 'Full name is required',
                    'min_length' => 'Name must be at least 3 characters long',
                    'max_length' => 'Name is too long',
                    'alpha_space' => 'Name can only contain letters and spaces'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|max_length[255]|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Please enter a valid email address',
                    'max_length' => 'Email address is too long',
                    'is_unique' => 'This email address is already registered'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|max_length[255]|regex_match[^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must be at least 8 characters long',
                    'max_length' => 'Password is too long',
                    'regex_match' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character'
                ]
            ],
            'password_confirm' => [
                'label' => 'Confirm Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Please confirm your password',
                    'matches' => 'Passwords do not match'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Additional security checks
        if ($this->isDisposableEmail($email)) {
            return redirect()->back()->withInput()->with('error', 'Please use a valid email address');
        }

        try {
            // Create user with secure password hashing
            $userData = [
                'name' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT), // Secure password hashing
                'role' => 'student', // default role
                'status' => 'active', // Add status field
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            // Use Query Builder to prevent SQL injection
            $this->userModel->save($userData);

            // Log registration event
            $this->logSecurityEvent('registration', null, $email);

            return redirect()->to('/auth/login')->with('success', 'Registration successful! Please login.');

        } catch (\Exception $e) {
            // Log error for debugging
            log_message('error', 'Registration error: ' . $e->getMessage());
            
            return redirect()->back()->withInput()->with('error', 'Registration failed. Please try again.');
        }
    }

    // Check for disposable email (basic check)
    protected function isDisposableEmail($email)
    {
        $disposableDomains = ['10minutemail.com', 'tempmail.org', 'guerrillamail.com'];
        $domain = substr(strrchr($email, "@"), 1);
        return in_array($domain, $disposableDomains);
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
