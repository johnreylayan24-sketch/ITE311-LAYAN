<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get user data from session
$user = $_SESSION['user'] ?? null;
$userRole = $user['role'] ?? 'guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title . ' - ' : '' ?>ITE311-LAYAN</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --text-primary: #2d3748;
            --text-secondary: #4a5568;
            --accent-color: #667eea;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: var(--primary-gradient);
            min-height: 100vh;
            color: var(--text-primary);
        }
        
        /* Navbar Styles */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--glass-border);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .navbar-nav .nav-link {
            color: var(--text-primary) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem !important;
        }
        
        .navbar-nav .nav-link:hover {
            background: var(--glass-bg);
            color: var(--accent-color) !important;
            transform: translateY(-2px);
        }
        
        .navbar-nav .nav-link.active {
            background: var(--primary-gradient);
            color: white !important;
        }
        
        .dropdown-menu {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        .dropdown-item {
            color: var(--text-primary) !important;
            border-radius: 8px;
            margin: 0.25rem 0.5rem;
            transition: all 0.3s ease;
        }
        
        .dropdown-item:hover {
            background: var(--glass-bg);
            color: var(--accent-color) !important;
        }
        
        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .badge-role {
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            text-transform: uppercase;
            font-weight: 600;
        }
        
        .badge-admin {
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            color: white;
        }
        
        .badge-teacher {
            background: linear-gradient(135deg, #4ecdc4, #44a08d);
            color: white;
        }
        
        .badge-student {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }
        
        .badge-guest {
            background: linear-gradient(135deg, #95a5a6, #7f8c8d);
            color: white;
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .navbar-nav {
                text-align: center;
            }
            
            .navbar-nav .nav-link {
                margin: 0.25rem 0;
            }
            
            .user-info {
                text-align: center;
                margin-top: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Dynamic Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand" href="<?= base_url() ?>">
                <i class="fas fa-graduation-cap me-2"></i>ITE311-LAYAN
            </a>
            
            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Items -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <!-- Home Link (Always Visible) -->
                    <li class="nav-item">
                        <a class="nav-link <?= (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] == '/' || basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : '' ?>" href="<?= base_url() ?>">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    
                    <!-- Role-specific Navigation -->
                    <?php if ($user && $userRole !== 'guest'): ?>
                        <!-- Admin Navigation -->
                        <?php if ($userRole === 'admin'): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-users-cog me-1"></i>Admin Panel
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?= base_url('dashboard') ?>">
                                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                    </a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('admin/users') ?>">
                                        <i class="fas fa-users me-2"></i>Manage Users
                                    </a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('admin/courses') ?>">
                                        <i class="fas fa-book me-2"></i>Manage Courses
                                    </a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('admin/settings') ?>">
                                        <i class="fas fa-cog me-2"></i>System Settings
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="<?= base_url('admin/analytics') ?>">
                                        <i class="fas fa-chart-bar me-2"></i>Analytics
                                    </a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('admin/reports') ?>">
                                        <i class="fas fa-file-alt me-2"></i>Reports
                                    </a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        
                        <!-- Teacher Navigation -->
                        <?php if ($userRole === 'teacher'): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-chalkboard-teacher me-1"></i>Teaching
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?= base_url('dashboard') ?>">
                                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                    </a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('teacher/courses') ?>">
                                        <i class="fas fa-book me-2"></i>My Courses
                                    </a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('teacher/assignments') ?>">
                                        <i class="fas fa-tasks me-2"></i>Assignments
                                    </a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('teacher/grades') ?>">
                                        <i class="fas fa-graduation-cap me-2"></i>Grade Management
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="<?= base_url('teacher/students') ?>">
                                        <i class="fas fa-users me-2"></i>Student Monitoring
                                    </a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        
                        <!-- Student Navigation -->
                        <?php if ($userRole === 'student'): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-graduate me-1"></i>Learning
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?= base_url('dashboard') ?>">
                                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                    </a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('student/courses') ?>">
                                        <i class="fas fa-book-open me-2"></i>My Courses
                                    </a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('student/assignments') ?>">
                                        <i class="fas fa-edit me-2"></i>Assignments
                                    </a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('student/grades') ?>">
                                        <i class="fas fa-chart-line me-2"></i>Grades
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="<?= base_url('student/schedule') ?>">
                                        <i class="fas fa-calendar me-2"></i>Schedule
                                    </a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        
                        <!-- Common Navigation for Logged-in Users -->
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('about') ?>">
                                <i class="fas fa-info-circle me-1"></i>About
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('contact') ?>">
                                <i class="fas fa-envelope me-1"></i>Contact
                            </a>
                        </li>
                        
                    <?php else: ?>
                        <!-- Guest Navigation -->
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('about') ?>">
                                <i class="fas fa-info-circle me-1"></i>About
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('contact') ?>">
                                <i class="fas fa-envelope me-1"></i>Contact
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
                
                <!-- User Section -->
                <ul class="navbar-nav">
                    <?php if ($user && $userRole !== 'guest'): ?>
                        <!-- Logged-in User -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                                <div class="user-avatar me-2">
                                    <?= strtoupper(substr($user['username'] ?? 'U', 0, 1)) ?>
                                </div>
                                <div class="d-none d-md-block">
                                    <div class="small"><?= esc($user['username'] ?? 'User') ?></div>
                                    <span class="badge-role badge-<?= $userRole ?>"><?= $userRole ?></span>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="<?= base_url('profile') ?>">
                                    <i class="fas fa-user me-2"></i>Profile
                                </a></li>
                                <li><a class="dropdown-item" href="<?= base_url('settings') ?>">
                                    <i class="fas fa-cog me-2"></i>Settings
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= base_url('auth/logout') ?>">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <!-- Guest User -->
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('auth/login') ?>">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('auth/register') ?>">
                                <i class="fas fa-user-plus me-1"></i>Register
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Main Content Area -->
    <main class="main-content">
        <!-- Content will be injected here by individual views -->
