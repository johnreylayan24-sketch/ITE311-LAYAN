<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function register()
    {
        $db = \Config\Database::connect();
        
        if ($this->request->getMethod() === 'POST') {
            // Set validation rules
            $validationRules = [
                'name' => [
                    'rules' => 'required|min_length[3]|max_length[100]',
                    'errors' => [
                        'required' => 'Name is required.',
                        'min_length' => 'Name must be at least 3 characters long.',
                        'max_length' => 'Name cannot exceed 100 characters.'
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email|is_unique[users.email]',
                    'errors' => [
                        'required' => 'Email is required.',
                        'valid_email' => 'Please enter a valid email address.',
                        'is_unique' => 'This email is already registered.'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[6]',
                    'errors' => [
                        'required' => 'Password is required.',
                        'min_length' => 'Password must be at least 6 characters long.'
                    ]
                ],
                'password_confirm' => [
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => 'Password confirmation is required.',
                        'matches' => 'Password confirmation does not match.'
                    ]
                ]
            ];

            if ($this->validate($validationRules)) {
                // Hash the password
                $hashedPassword = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

                // Prepare user data
                $userData = [
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                    'password' => $hashedPassword,
                    'role' => 'student', // Default role
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                // Insert user into database
                $builder = $db->table('users');
                if ($builder->insert($userData)) {
                    session()->setFlashdata('success', 'Registration successful! Please log in.');
                    return redirect()->to('/login');
                } else {
                    session()->setFlashdata('error', 'Registration failed. Please try again.');
                }
            } else {
                session()->setFlashdata('errors', $this->validator->getErrors());
            }
        }

        return view('auth/register');
    }

    public function login()
    {
        $db = \Config\Database::connect();
        
        if ($this->request->getMethod() === 'POST') {
            // Set validation rules
            $validationRules = [
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email is required.',
                        'valid_email' => 'Please enter a valid email address.'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password is required.'
                    ]
                ]
            ];

            if ($this->validate($validationRules)) {
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');

                // Check if user exists
                $builder = $db->table('users');
                $user = $builder->where('email', $email)->get()->getRowArray();

                if ($user && password_verify($password, $user['password'])) {
                    // Create user session
                    $sessionData = [
                        'userID' => $user['id'],
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'role' => $user['role'],
                        'isLoggedIn' => true
                    ];
                    
                    session()->set($sessionData);
                    session()->setFlashdata('success', 'Welcome, ' . $user['name'] . '!');
                    return redirect()->to('/dashboard');
                } else {
                    session()->setFlashdata('error', 'Invalid email or password.');
                }
            } else {
                session()->setFlashdata('errors', $this->validator->getErrors());
            }
        }

        return view('auth/login');
    }

    public function logout()
    {
        // Destroy the session
        session()->destroy();
        session()->setFlashdata('success', 'You have been logged out successfully.');
        return redirect()->to('/login');
    }

    public function dashboard()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Please log in to access the dashboard.');
            return redirect()->to('/login');
        }

        // Get user role from session
        $userRole = session()->get('role');
        
        // Prepare base user data
        $data = [
            'user' => [
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'role' => $userRole
            ]
        ];

        // Implement role-based conditional checks
        switch ($userRole) {
            case 'admin':
                // Admin-specific data and functionality
                $data['admin_features'] = [
                    'user_management' => true,
                    'system_settings' => true,
                    'analytics' => true,
                    'total_users' => $this->getTotalUsers(),
                    'recent_activities' => $this->getRecentActivities()
                ];
                $data['dashboard_title'] = 'Admin Dashboard';
                break;
                
            case 'teacher':
                // Teacher-specific data and functionality
                $data['teacher_features'] = [
                    'course_management' => true,
                    'grade_management' => true,
                    'student_monitoring' => true,
                    'my_courses' => $this->getTeacherCourses(),
                    'pending_submissions' => $this->getPendingSubmissions()
                ];
                $data['dashboard_title'] = 'Teacher Dashboard';
                break;
                
            case 'student':
                // Student-specific data and functionality
                $data['student_features'] = [
                    'course_enrollment' => true,
                    'assignment_submission' => true,
                    'grade_viewing' => true,
                    'my_courses' => $this->getStudentCourses(),
                    'recent_grades' => $this->getStudentGrades()
                ];
                $data['dashboard_title'] = 'Student Dashboard';
                break;
                
            default:
                // Handle unknown roles
                session()->setFlashdata('error', 'Invalid user role detected.');
                return redirect()->to('/login');
        }

        return view('dashboard', $data);
    }

    /**
     * Helper method to get total users count (Admin)
     */
    private function getTotalUsers()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        return $builder->countAllResults();
    }

    /**
     * Helper method to get recent activities (Admin)
     */
    private function getRecentActivities()
    {
        // This would typically query a logs or activities table
        return [
            ['action' => 'New user registration', 'time' => '2 hours ago'],
            ['action' => 'Course created', 'time' => '5 hours ago'],
            ['action' => 'Assignment submitted', 'time' => '1 day ago']
        ];
    }

    /**
     * Helper method to get teacher courses (Teacher)
     */
    private function getTeacherCourses()
    {
        // This would typically query courses where teacher is assigned
        return [
            ['name' => 'Web Development', 'students' => 25],
            ['name' => 'Database Design', 'students' => 18]
        ];
    }

    /**
     * Helper method to get pending submissions (Teacher)
     */
    private function getPendingSubmissions()
    {
        // This would typically query pending assignments/submissions
        return 12; // Example count
    }

    /**
     * Helper method to get student courses (Student)
     */
    private function getStudentCourses()
    {
        // This would typically query courses where student is enrolled
        return [
            ['name' => 'Web Development', 'progress' => 75],
            ['name' => 'Database Design', 'progress' => 60]
        ];
    }

    /**
     * Helper method to get student grades (Student)
     */
    private function getStudentGrades()
    {
        // This would typically query student grades
        return [
            ['assignment' => 'Midterm Exam', 'grade' => 85],
            ['assignment' => 'Project Proposal', 'grade' => 92]
        ];
    }
}
