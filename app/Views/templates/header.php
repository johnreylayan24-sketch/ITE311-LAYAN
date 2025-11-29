<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'LMS System' ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .nav-link { transition: all 0.3s; }
        .nav-link:hover { opacity: 0.8; }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= base_url('dashboard') ?>">
                <i class="fas fa-graduation-cap me-2"></i>LMS
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <?php if (session()->get('isLoggedIn')): ?>
                    <!-- Left Side Navigation -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('dashboard') ?>">
                                <i class="fas fa-home me-1"></i> Dashboard
                            </a>
                        </li>
                        
                        <?php if (session()->get('user_role') === 'admin'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('admin/users') ?>">
                                    <i class="fas fa-users me-1"></i> Users
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('admin/courses') ?>">
                                    <i class="fas fa-book me-1"></i> Courses
                                </a>
                            </li>
                        <?php elseif (session()->get('user_role') === 'teacher'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('teacher/courses') ?>">
                                    <i class="fas fa-book me-1"></i> My Courses
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('teacher/assignments') ?>">
                                    <i class="fas fa-tasks me-1"></i> Assignments
                                </a>
                            </li>
                        <?php elseif (session()->get('user_role') === 'student'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('student/courses') ?>">
                                    <i class="fas fa-book me-1"></i> My Courses
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('student/grades') ?>">
                                    <i class="fas fa-chart-line me-1"></i> Grades
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    
                    <!-- Right Side - User Menu -->
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i>
                                <?= session()->get('user_name') ?>
                                <span class="badge bg-light text-primary ms-1"><?= ucfirst(session()->get('user_role')) ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('profile') ?>">
                                        <i class="fas fa-user me-2"></i> Profile
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="<?= base_url('logout') ?>">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                <?php else: ?>
                    <!-- Guest Navigation -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="<?= base_url('login') ?>" class="btn btn-outline-light me-2">
                                <i class="fas fa-sign-in-alt me-1"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('register') ?>" class="btn btn-light">
                                <i class="fas fa-user-plus me-1"></i> Register
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <?php if (session()->get('isLoggedIn')): ?>
                <!-- Sidebar -->
                <div class="col-md-2 d-none d-md-block sidebar">
                    <div class="position-sticky">
                        <div class="text-center mb-4">
                            <img src="https://via.placeholder.com/100" class="rounded-circle mb-2" alt="Profile" width="80">
                            <h6 class="mb-0"><?= session()->get('user_name') ?></h6>
                            <small class="text-muted"><?= ucfirst(session()->get('user_role')) ?></small>
                        </div>
                        
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link <?= current_url() === base_url('dashboard') ? 'active' : '' ?>" href="<?= base_url('dashboard') ?>">
                                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                                </a>
                            </li>
                            
                            <?php if (session()->get('user_role') === 'admin'): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= strpos(current_url(), '/admin/users') !== false ? 'active' : '' ?>" href="<?= base_url('admin/users') ?>">
                                        <i class="fas fa-users me-2"></i> Users
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= strpos(current_url(), '/admin/courses') !== false ? 'active' : '' ?>" href="<?= base_url('admin/courses') ?>">
                                        <i class="fas fa-book me-2"></i> Courses
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= strpos(current_url(), '/admin/settings') !== false ? 'active' : '' ?>" href="<?= base_url('admin/settings') ?>">
                                        <i class="fas fa-cog me-2"></i> Settings
                                    </a>
                                </li>
                            <?php elseif (session()->get('user_role') === 'teacher'): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= strpos(current_url(), '/teacher/courses') !== false ? 'active' : '' ?>" href="<?= base_url('teacher/courses') ?>">
                                        <i class="fas fa-book me-2"></i> My Courses
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= strpos(current_url(), '/teacher/assignments') !== false ? 'active' : '' ?>" href="<?= base_url('teacher/assignments') ?>">
                                        <i class="fas fa-tasks me-2"></i> Assignments
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= strpos(current_url(), '/teacher/grades') !== false ? 'active' : '' ?>" href="<?= base_url('teacher/grades') ?>">
                                        <i class="fas fa-graduation-cap me-2"></i> Gradebook
                                    </a>
                                </li>
                            <?php elseif (session()->get('user_role') === 'student'): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= strpos(current_url(), '/student/courses') !== false ? 'active' : '' ?>" href="<?= base_url('student/courses') ?>">
                                        <i class="fas fa-book me-2"></i> My Courses
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= strpos(current_url(), '/student/assignments') !== false ? 'active' : '' ?>" href="<?= base_url('student/assignments') ?>">
                                        <i class="fas fa-tasks me-2"></i> Assignments
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= strpos(current_url(), '/student/grades') !== false ? 'active' : '' ?>" href="<?= base_url('student/grades') ?>">
                                        <i class="fas fa-graduation-cap me-2"></i> My Grades
                                    </a>
                                </li>
                            <?php endif; ?>
                            
                            <li class="nav-item mt-3">
                                <a class="nav-link" href="<?= base_url('profile') ?>">
                                    <i class="fas fa-user me-2"></i> Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-danger" href="<?= base_url('logout') ?>">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Main Content -->
                <main class="col-md-10 ms-sm-auto px-md-4 py-4">
            <?php else: ?>
                <main class="col-12 py-4">
            <?php endif; ?>
                
                <!-- Display flash messages -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
