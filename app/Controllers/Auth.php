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
        // Enhanced authorization check
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Please log in to access the dashboard.');
            return redirect()->to('/login');
        }

        // Get user data from session
        $userId = session()->get('userID');
        $userRole = session()->get('role');
        $userName = session()->get('name');
        $userEmail = session()->get('email');

        // Validate session data integrity
        if (empty($userId) || empty($userRole) || empty($userName) || empty($userEmail)) {
            session()->destroy();
            session()->setFlashdata('error', 'Session corrupted. Please log in again.');
            return redirect()->to('/login');
        }

        // Verify user still exists in database
        $db = \Config\Database::connect();
        $user = $db->table('users')->where('id', $userId)->get()->getRowArray();
        
        if (!$user) {
            session()->destroy();
            session()->setFlashdata('error', 'User account not found. Please log in again.');
            return redirect()->to('/login');
        }

        // Verify role matches database
        if ($user['role'] !== $userRole) {
            // Update session with correct role from database
            session()->set('role', $user['role']);
            $userRole = $user['role'];
        }

        // Prepare comprehensive user data
        $data = [
            'user' => [
                'id' => $userId,
                'name' => $userName,
                'email' => $userEmail,
                'role' => $userRole,
                'created_at' => $user['created_at'],
                'last_login' => date('Y-m-d H:i:s')
            ],
            'system_info' => [
                'total_users' => $this->getTotalUsers(),
                'system_time' => date('Y-m-d H:i:s'),
                'server_info' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown'
            ]
        ];

        // Implement enhanced role-based conditional checks with real data
        switch ($userRole) {
            case 'admin':
                // Enhanced admin-specific data with real database queries
                $data['admin_features'] = [
                    'user_management' => true,
                    'system_settings' => true,
                    'analytics' => true,
                    'total_users' => $this->getTotalUsers(),
                    'total_admins' => $this->getUsersByRole('admin'),
                    'total_teachers' => $this->getUsersByRole('teacher'),
                    'total_students' => $this->getUsersByRole('student'),
                    'total_courses' => $this->getTotalCourses(),
                    'recent_users' => $this->getRecentUsers(),
                    'recent_activities' => $this->getRecentActivities(),
                    'system_stats' => $this->getSystemStats()
                ];
                $data['dashboard_title'] = 'Admin Dashboard';
                $data['analytics_data'] = $this->getAnalyticsData();
                break;
                
            case 'teacher':
                // Enhanced teacher-specific data with real database queries
                $data['teacher_features'] = [
                    'course_management' => true,
                    'grade_management' => true,
                    'student_monitoring' => true,
                    'my_courses' => $this->getTeacherCourses($userId),
                    'pending_submissions' => $this->getPendingSubmissions($userId),
                    'total_students' => $this->getTeacherStudentsCount($userId),
                    'recent_grades' => $this->getTeacherRecentGrades($userId),
                    'total_courses' => count($this->getTeacherCourses($userId)),
                    'total_assignments' => $this->getTeacherAssignmentsCount($userId),
                    'pending_submissions_list' => $this->getTeacherPendingSubmissionsList($userId)
                ];
                $data['dashboard_title'] = 'Teacher Dashboard';
                $data['teacher_stats'] = $this->getTeacherStats($userId);
                break;
                
            case 'student':
                // Enhanced student-specific data with real database queries
                $data['student_features'] = [
                    'course_enrollment' => true,
                    'assignment_submission' => true,
                    'grade_viewing' => true,
                    'my_courses' => $this->getStudentCourses($userId),
                    'recent_grades' => $this->getStudentGrades($userId),
                    'pending_assignments' => $this->getStudentPendingAssignments($userId),
                    'overall_gpa' => $this->getStudentGPA($userId),
                    'enrolled_courses' => count($this->getStudentCourses($userId)),
                    'completed_assignments' => $this->getStudentCompletedAssignments($userId),
                    'average_grade' => $this->getStudentGPA($userId)
                ];
                $data['dashboard_title'] = 'Student Dashboard';
                $data['student_stats'] = $this->getStudentStats($userId);
                break;
                
            default:
                // Enhanced handling for unknown roles
                log_message('error', 'Unknown role detected: ' . $userRole . ' for user ID: ' . $userId);
                session()->setFlashdata('error', 'Invalid user role detected. Please contact administrator.');
                return redirect()->to('/login');
        }

        // Add common dashboard data
        $data['notifications'] = $this->getUserNotifications($userId);
        $data['quick_actions'] = $this->getQuickActions($userRole);
        
        // Log dashboard access
        $this->logDashboardAccess($userId, $userRole);

        return view('auth/dashboard', $data);
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
     * Helper method to get student grades (Student)
     */
    private function getStudentGrades($userId = null)
    {
        $db = \Config\Database::connect();
        
        if ($userId) {
            // Check if grades and assignments tables exist first
            if ($db->tableExists('grades') && $db->tableExists('assignments')) {
                // Real database query for specific student
                $builder = $db->table('grades');
                $builder->join('assignments', 'assignments.id = grades.assignment_id', 'left');
                $grades = $builder->where('grades.student_id', $userId)
                                  ->select('grades.*, assignments.title as assignment_title, grades.created_at as graded_at')
                                  ->orderBy('grades.created_at', 'DESC')
                                  ->limit(10)
                                  ->get()
                                  ->getResultArray();
                
                // Format the results to ensure required fields exist
                $formattedGrades = [];
                foreach ($grades as $grade) {
                    $formattedGrades[] = [
                        'grade' => $grade['grade'] ?? 'N/A',
                        'assignment_title' => $grade['assignment_title'] ?? 'Unknown Assignment',
                        'graded_at' => $grade['graded_at'] ?? $grade['created_at'] ?? date('Y-m-d H:i:s')
                    ];
                }
                
                return $formattedGrades ?: [
                    ['grade' => 'N/A', 'assignment_title' => 'No grades available', 'graded_at' => date('Y-m-d H:i:s')]
                ];
            } elseif ($db->tableExists('grades')) {
                // Only grades table exists, no assignments table
                $builder = $db->table('grades');
                $grades = $builder->where('student_id', $userId)
                                  ->orderBy('created_at', 'DESC')
                                  ->limit(10)
                                  ->get()
                                  ->getResultArray();
                
                // Format the results
                $formattedGrades = [];
                foreach ($grades as $grade) {
                    $formattedGrades[] = [
                        'grade' => $grade['grade'] ?? 'N/A',
                        'assignment_title' => 'Assignment #' . ($grade['assignment_id'] ?? 'Unknown'),
                        'graded_at' => $grade['created_at'] ?? date('Y-m-d H:i:s')
                    ];
                }
                
                return $formattedGrades ?: [
                    ['grade' => 'N/A', 'assignment_title' => 'No grades available', 'graded_at' => date('Y-m-d H:i:s')]
                ];
            } else {
                // Grades table doesn't exist, return fallback data
                return [
                    ['grade' => 'N/A', 'assignment_title' => 'No grades available (Grades table not found)', 'graded_at' => date('Y-m-d H:i:s')]
                ];
            }
        } else {
            // Fallback for backward compatibility
            return [
                ['grade' => 'A', 'assignment_title' => 'Web Development Basics', 'graded_at' => date('Y-m-d H:i:s', strtotime('-2 days'))],
                ['grade' => 'B+', 'assignment_title' => 'Database Design', 'graded_at' => date('Y-m-d H:i:s', strtotime('-5 days'))],
                ['grade' => 'A-', 'assignment_title' => 'PHP Programming', 'graded_at' => date('Y-m-d H:i:s', strtotime('-1 week'))]
            ];
        }
    }

    /**
     * Helper method to get recent users (Admin)
     */
    private function getRecentUsers()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        return $builder->select('id, name, email, role, created_at')
                      ->orderBy('created_at', 'DESC')
                      ->limit(5)
                      ->get()
                      ->getResultArray();
    }

    /**
     * Helper method to get system stats (Admin)
     */
    private function getSystemStats()
    {
        $db = \Config\Database::connect();
        
        return [
            'database_size' => $this->getDatabaseSize(),
            'server_load' => $this->getServerLoad(),
            'memory_usage' => $this->getMemoryUsage(),
            'disk_usage' => $this->getDiskUsage()
        ];
    }

    /**
     * Helper method to get analytics data (Admin)
     */
    private function getAnalyticsData()
    {
        $db = \Config\Database::connect();
        
        // Get user registration trends
        $builder = $db->table('users');
        $last7Days = date('Y-m-d', strtotime('-7 days'));
        $newUsers = $builder->where('created_at >=', $last7Days)->countAllResults();
        
        return [
            'new_users_last_7_days' => $newUsers,
            'user_growth_rate' => $this->calculateUserGrowthRate(),
            'role_distribution' => [
                'admin' => $this->getUsersByRole('admin'),
                'teacher' => $this->getUsersByRole('teacher'),
                'student' => $this->getUsersByRole('student')
            ],
            'system_uptime' => $this->getSystemUptime()
        ];
    }

    /**
     * Helper method to get teacher courses with user ID
     */
    private function getTeacherCourses($teacherId = null)
    {
        $db = \Config\Database::connect();
        
        if ($teacherId) {
            // Real database query for specific teacher
            $builder = $db->table('courses');
            $courses = $builder->where('teacher_id', $teacherId)
                              ->get()
                              ->getResultArray();
            
            return $courses ?: [
                ['name' => 'No courses assigned', 'students' => 0, 'status' => 'inactive']
            ];
        } else {
            // Fallback for backward compatibility
            return [
                ['name' => 'Web Development', 'students' => 25],
                ['name' => 'Database Design', 'students' => 18]
            ];
        }
    }

    /**
     * Helper method to get pending submissions with user ID
     */
    private function getPendingSubmissions($teacherId = null)
    {
        $db = \Config\Database::connect();
        
        if ($teacherId) {
            // Check if assignments table exists first
            if ($db->tableExists('assignments') && $db->tableExists('submissions')) {
                // Real database query for specific teacher
                $builder = $db->table('submissions');
                $builder->join('assignments', 'assignments.id = submissions.assignment_id');
                $pendingCount = $builder->where('assignments.teacher_id', $teacherId)
                                       ->countAllResults();
                
                return $pendingCount;
            } else {
                // Assignments or submissions table doesn't exist, return 0
                return 0;
            }
        } else {
            // Fallback for backward compatibility
            return 12;
        }
    }

    /**
     * Helper method to get teacher students count
     */
    private function getTeacherStudentsCount($teacherId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('enrollments');
        $builder->join('courses', 'courses.id = enrollments.course_id');
        return $builder->where('courses.teacher_id', $teacherId)
                      ->countAllResults();
    }

    /**
     * Helper method to get teacher recent grades
     */
    private function getTeacherRecentGrades($teacherId)
    {
        $db = \Config\Database::connect();
        
        // Check if grades table exists first
        if ($db->tableExists('grades')) {
            $builder = $db->table('grades');
            $builder->join('users', 'users.id = grades.student_id');
            return $builder->where('grades.teacher_id', $teacherId)
                          ->orderBy('grades.created_at', 'DESC')
                          ->limit(5)
                          ->get()
                          ->getResultArray();
        } else {
            // Grades table doesn't exist, return empty array
            return [];
        }
    }

    /**
     * Helper method to get teacher stats
     */
    private function getTeacherStats($teacherId)
    {
        $db = \Config\Database::connect();
        
        return [
            'total_courses' => count($this->getTeacherCourses($teacherId)),
            'total_students' => $this->getTeacherStudentsCount($teacherId),
            'pending_submissions' => $this->getPendingSubmissions($teacherId),
            'average_grade' => $this->getTeacherAverageGrade($teacherId)
        ];
    }

    /**
     * Helper method to get student courses with user ID
     */
    private function getStudentCourses($studentId = null)
    {
        $db = \Config\Database::connect();
        
        if ($studentId) {
            // Real database query for specific student
            $builder = $db->table('enrollments');
            $builder->join('courses', 'courses.id = enrollments.course_id');
            $courses = $builder->where('enrollments.student_id', $studentId)
                              ->get()
                              ->getResultArray();
            
            return $courses ?: [
                ['name' => 'No courses enrolled', 'progress' => 0, 'status' => 'inactive']
            ];
        } else {
            // Fallback for backward compatibility
            return [
                ['name' => 'Web Development', 'progress' => 75],
                ['name' => 'Database Design', 'progress' => 60]
            ];
        }
    }

    /**
     * Helper method to get student pending assignments
     */
    private function getStudentPendingAssignments($studentId)
    {
        $db = \Config\Database::connect();
        
        // Check if assignments table exists first
        if ($db->tableExists('assignments') && $db->tableExists('submissions')) {
            $builder = $db->table('assignments');
            $builder->join('enrollments', 'enrollments.course_id = assignments.course_id');
            $builder->join('submissions', 'submissions.assignment_id = assignments.id AND submissions.student_id = ' . $studentId, 'left');
            
            return $builder->where('enrollments.student_id', $studentId)
                          ->where('assignments.due_date >', date('Y-m-d H:i:s'))
                          ->where('submissions.id IS NULL')
                          ->countAllResults();
        } else {
            // Assignments or submissions table doesn't exist, return 0
            return 0;
        }
    }

    /**
     * Helper method to get student GPA
     */
    private function getStudentGPA($studentId)
    {
        $db = \Config\Database::connect();
        
        // Check if grades table exists first
        if ($db->tableExists('grades')) {
            $builder = $db->table('grades');
            $grades = $builder->select('grade')
                             ->where('student_id', $studentId)
                             ->get()
                             ->getResultArray();
            
            if (empty($grades)) {
                return 0.0;
            }
            
            $total = 0;
            $count = 0;
            foreach ($grades as $grade) {
                if (is_numeric($grade['grade'])) {
                    $total += $grade['grade'];
                    $count++;
                }
            }
            
            return $count > 0 ? round($total / $count, 2) : 0.0;
        } else {
            // Grades table doesn't exist, return 0.0
            return 0.0;
        }
    }

    /**
     * Helper method to get student stats
     */
    private function getStudentStats($studentId)
    {
        $db = \Config\Database::connect();
        
        return [
            'total_courses' => count($this->getStudentCourses($studentId)),
            'pending_assignments' => $this->getStudentPendingAssignments($studentId),
            'overall_gpa' => $this->getStudentGPA($studentId),
            'completed_assignments' => $this->getStudentCompletedAssignments($studentId)
        ];
    }

    /**
     * Helper method to get user notifications
     */
    private function getUserNotifications($userId)
    {
        $db = \Config\Database::connect();
        
        // Check if notifications table exists first
        if ($db->tableExists('notifications')) {
            $builder = $db->table('notifications');
            return $builder->where('user_id', $userId)
                          ->where('is_read', 0)
                          ->orderBy('created_at', 'DESC')
                          ->limit(5)
                          ->get()
                          ->getResultArray();
        } else {
            // Notifications table doesn't exist, return empty array
            return [];
        }
    }

    /**
     * Helper method to get quick actions by role
     */
    private function getQuickActions($role)
    {
        $actions = [
            'admin' => [
                ['icon' => 'fas fa-users', 'label' => 'Manage Users', 'url' => '/admin/users', 'primary' => true],
                ['icon' => 'fas fa-cog', 'label' => 'System Settings', 'url' => '/admin/settings', 'primary' => false],
                ['icon' => 'fas fa-chart-bar', 'label' => 'Analytics', 'url' => '/admin/analytics', 'primary' => false],
                ['icon' => 'fas fa-file-alt', 'label' => 'Reports', 'url' => '/admin/reports', 'primary' => false]
            ],
            'teacher' => [
                ['icon' => 'fas fa-book', 'label' => 'Course Management', 'url' => '/teacher/courses', 'primary' => true],
                ['icon' => 'fas fa-graduation-cap', 'label' => 'Grade Management', 'url' => '/teacher/grades', 'primary' => false],
                ['icon' => 'fas fa-users', 'label' => 'Student Monitoring', 'url' => '/teacher/students', 'primary' => false],
                ['icon' => 'fas fa-tasks', 'label' => 'Assignments', 'url' => '/teacher/assignments', 'primary' => false]
            ],
            'student' => [
                ['icon' => 'fas fa-book-open', 'label' => 'My Courses', 'url' => '/student/courses', 'primary' => true],
                ['icon' => 'fas fa-edit', 'label' => 'Assignments', 'url' => '/student/assignments', 'primary' => false],
                ['icon' => 'fas fa-chart-line', 'label' => 'Grades', 'url' => '/student/grades', 'primary' => false],
                ['icon' => 'fas fa-calendar', 'label' => 'Schedule', 'url' => '/student/schedule', 'primary' => false]
            ]
        ];
        
        return $actions[$role] ?? [];
    }

    /**
     * Helper method to log dashboard access
     */
    private function logDashboardAccess($userId, $role)
    {
        $db = \Config\Database::connect();
        
        // Check if user_logs table exists first
        if ($db->tableExists('user_logs')) {
            $builder = $db->table('user_logs');
            
            $logData = [
                'user_id' => $userId,
                'action' => 'dashboard_access',
                'role' => $role,
                'ip_address' => $this->request->getIPAddress(),
                'user_agent' => $this->request->getUserAgent(),
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $builder->insert($logData);
        }
        // If user_logs table doesn't exist, just skip logging
    }

    /**
     * Helper method to get database size
     */
    private function getDatabaseSize()
    {
        $db = \Config\Database::connect();
        try {
            $query = $db->query("SELECT table_schema AS db_name, 
                                SUM(data_length + index_length) AS size 
                                FROM information_schema.tables 
                                WHERE table_schema = '{$db->database}' 
                                GROUP BY table_schema");
            $result = $query->getRowArray();
            return $result ? round($result['size'] / 1024 / 1024, 2) : 0; // Size in MB
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Helper method to get server load
     */
    private function getServerLoad()
    {
        if (function_exists('sys_getloadavg')) {
            $load = sys_getloadavg();
            return $load[0] ?? 0;
        }
        return 0;
    }

    /**
     * Helper method to get memory usage
     */
    private function getMemoryUsage()
    {
        if (function_exists('memory_get_usage')) {
            return round(memory_get_usage(true) / 1024 / 1024, 2); // MB
        }
        return 0;
    }

    /**
     * Helper method to get disk usage
     */
    private function getDiskUsage()
    {
        $freeSpace = disk_free_space('/');
        $totalSpace = disk_total_space('/');
        $usedSpace = $totalSpace - $freeSpace;
        
        return [
            'total' => round($totalSpace / 1024 / 1024 / 1024, 2), // GB
            'used' => round($usedSpace / 1024 / 1024 / 1024, 2),   // GB
            'free' => round($freeSpace / 1024 / 1024 / 1024, 2),   // GB
            'percentage' => round(($usedSpace / $totalSpace) * 100, 1)
        ];
    }

    /**
     * Helper method to calculate user growth rate
     */
    private function calculateUserGrowthRate()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        
        $last30Days = date('Y-m-d', strtotime('-30 days'));
        $last60Days = date('Y-m-d', strtotime('-60 days'));
        
        $recentUsers = $builder->where('created_at >=', $last30Days)->countAllResults();
        $previousUsers = $builder->where('created_at >=', $last60Days)
                                ->where('created_at <', $last30Days)->countAllResults();
        
        if ($previousUsers == 0) {
            return $recentUsers > 0 ? 100 : 0;
        }
        
        return round((($recentUsers - $previousUsers) / $previousUsers) * 100, 1);
    }

    /**
     * Helper method to get system uptime
     */
    private function getSystemUptime()
    {
        if (function_exists('exec')) {
            try {
                $uptime = exec('uptime');
                return $uptime ?: 'Unknown';
            } catch (\Exception $e) {
                return 'Unknown';
            }
        }
        return 'Unknown';
    }

    /**
     * Helper method to get teacher average grade
     */
    private function getTeacherAverageGrade($teacherId)
    {
        $db = \Config\Database::connect();
        
        // Check if grades table exists first
        if ($db->tableExists('grades')) {
            $builder = $db->table('grades');
            $grades = $builder->select('grade')
                             ->where('teacher_id', $teacherId)
                             ->get()
                             ->getResultArray();
            
            if (empty($grades)) {
                return 0.0;
            }
            
            $total = 0;
            $count = 0;
            foreach ($grades as $grade) {
                if (is_numeric($grade['grade'])) {
                    $total += $grade['grade'];
                    $count++;
                }
            }
            
            return $count > 0 ? round($total / $count, 2) : 0.0;
        } else {
            // Grades table doesn't exist, return 0.0
            return 0.0;
        }
    }

    /**
     * Helper method to get student completed assignments
     */
    private function getStudentCompletedAssignments($studentId)
    {
        $db = \Config\Database::connect();
        
        // Check if submissions table exists first
        if ($db->tableExists('submissions')) {
            $builder = $db->table('submissions');
            return $builder->where('student_id', $studentId)
                          ->countAllResults();
        } else {
            // Submissions table doesn't exist, return 0
            return 0;
        }
    }

    /**
     * Helper method to get total courses count
     */
    private function getTotalCourses()
    {
        $db = \Config\Database::connect();
        
        // Check if courses table exists first
        if ($db->tableExists('courses')) {
            $builder = $db->table('courses');
            return $builder->countAllResults();
        } else {
            // Courses table doesn't exist, return 0
            return 0;
        }
    }

    /**
     * Helper method to get teacher assignments count
     */
    private function getTeacherAssignmentsCount($teacherId)
    {
        $db = \Config\Database::connect();
        
        // Check if assignments table exists first
        if ($db->tableExists('assignments')) {
            $builder = $db->table('assignments');
            return $builder->where('teacher_id', $teacherId)
                          ->countAllResults();
        } else {
            // Assignments table doesn't exist, return 0
            return 0;
        }
    }

    /**
     * Helper method to get teacher pending submissions list
     */
    private function getTeacherPendingSubmissionsList($teacherId)
    {
        $db = \Config\Database::connect();
        
        // Check if assignments and submissions tables exist first
        if ($db->tableExists('assignments') && $db->tableExists('submissions')) {
            $builder = $db->table('submissions');
            $builder->join('assignments', 'assignments.id = submissions.assignment_id');
            $builder->join('users', 'users.id = submissions.student_id');
            return $builder->where('assignments.teacher_id', $teacherId)
                          ->select('submissions.*, assignments.title as assignment_title, users.name as student_name')
                          ->orderBy('submissions.created_at', 'DESC')
                          ->limit(5)
                          ->get()
                          ->getResultArray();
        } else {
            // Tables don't exist, return empty array
            return [];
        }
    }
}
