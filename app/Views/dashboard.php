<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ITE311-LAYAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            line-height: 1.6;
        }

        .navbar {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--glass-border);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            color: white !important;
            font-size: 1.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 0.5rem;
        }

        .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .stat-card {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            color: white;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .stat-card h3 {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .stat-card .stat-number {
            font-size: 3rem;
            font-weight: 700;
            background: var(--secondary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .btn-custom {
            background: var(--primary-gradient);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-outline-custom {
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-outline-custom:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
            transform: translateY(-2px);
        }

        .welcome-section {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            color: white;
        }

        .welcome-section h2 {
            color: white;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .badge-custom {
            background: var(--secondary-gradient);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
        }

        .alert {
            border: none;
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        .alert-success {
            background: rgba(72, 187, 120, 0.2);
            color: white;
            border: 1px solid rgba(72, 187, 120, 0.3);
        }

        .alert-danger {
            background: rgba(245, 101, 101, 0.2);
            color: white;
            border: 1px solid rgba(245, 101, 101, 0.3);
        }

        .dropdown-menu {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
        }

        .dropdown-item {
            color: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .footer {
            background: rgba(0, 0, 0, 0.2);
            color: rgba(255, 255, 255, 0.8);
            padding: 2rem 0;
            margin-top: 4rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/') ?>">
                <i class="fas fa-graduation-cap me-2"></i>ITE311-LAYAN
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/') ?>">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
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
                </ul>
                <div class="d-flex">
                    <div class="dropdown">
                        <button class="btn btn-outline-custom dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-2"></i><?= $user['name'] ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user-edit me-2"></i>Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Welcome Section -->
        <div class="welcome-section">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2><i class="fas fa-user-circle me-3"></i>Welcome back, <?= $user['name'] ?>!</h2>
                    <p class="mb-2"><i class="fas fa-tag me-2"></i>Role: <span class="badge-custom"><?= ucfirst($user['role']) ?></span></p>
                    <p class="mb-0"><i class="fas fa-envelope me-2"></i>Email: <?= $user['email'] ?></p>
                </div>
                <div class="col-md-4 text-end">
                    <?php if (isset($dashboard_title)): ?>
                        <h4 class="text-white mb-3"><?= $dashboard_title ?></h4>
                    <?php endif; ?>
                    
                    <?php if ($user['role'] === 'admin' && isset($admin_features['total_users'])): ?>
                        <div class="d-flex justify-content-end">
                            <div class="text-center me-4">
                                <h3 class="stat-number"><?= $admin_features['total_users'] ?></h3>
                                <p class="mb-0">Total Users</p>
                            </div>
                            <div class="text-center">
                                <h3 class="stat-number">3</h3>
                                <p class="mb-0">Roles</p>
                            </div>
                        </div>
                    <?php elseif ($user['role'] === 'teacher' && isset($teacher_features['my_courses'])): ?>
                        <div class="d-flex justify-content-end">
                            <div class="text-center me-4">
                                <h3 class="stat-number"><?= count($teacher_features['my_courses']) ?></h3>
                                <p class="mb-0">My Courses</p>
                            </div>
                            <div class="text-center">
                                <h3 class="stat-number"><?= $teacher_features['pending_submissions'] ?></h3>
                                <p class="mb-0">Pending</p>
                            </div>
                        </div>
                    <?php elseif ($user['role'] === 'student' && isset($student_features['my_courses'])): ?>
                        <div class="d-flex justify-content-end">
                            <div class="text-center me-4">
                                <h3 class="stat-number"><?= count($student_features['my_courses']) ?></h3>
                                <p class="mb-0">Courses</p>
                            </div>
                            <div class="text-center">
                                <h3 class="stat-number"><?= count($student_features['recent_grades']) ?></h3>
                                <p class="mb-0">Grades</p>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="d-flex justify-content-end">
                            <div class="text-center me-4">
                                <h3 class="stat-number">0</h3>
                                <p class="mb-0">Courses</p>
                            </div>
                            <div class="text-center">
                                <h3 class="stat-number">0%</h3>
                                <p class="mb-0">Progress</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Role-based Dashboard Stats -->
        <div class="row g-4 mb-4">
            <?php if ($user['role'] === 'admin' && isset($admin_features)): ?>
                <!-- Admin Stats -->
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                        <h3>Total Users</h3>
                        <div class="stat-number"><?= $admin_features['total_users'] ?></div>
                        <p class="mt-2">Registered Users</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-chalkboard-teacher fa-3x"></i>
                        </div>
                        <h3>Teachers</h3>
                        <div class="stat-number">2</div>
                        <p class="mt-2">Active Teachers</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-user-graduate fa-3x"></i>
                        </div>
                        <h3>Students</h3>
                        <div class="stat-number"><?= $admin_features['total_users'] - 3 ?></div>
                        <p class="mt-2">Enrolled Students</p>
                    </div>
                </div>
            <?php elseif ($user['role'] === 'teacher' && isset($teacher_features)): ?>
                <!-- Teacher Stats -->
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-book fa-3x"></i>
                        </div>
                        <h3>My Courses</h3>
                        <div class="stat-number"><?= count($teacher_features['my_courses']) ?></div>
                        <p class="mt-2">Courses Assigned</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-tasks fa-3x"></i>
                        </div>
                        <h3>Pending</h3>
                        <div class="stat-number"><?= $teacher_features['pending_submissions'] ?></div>
                        <p class="mt-2">Submissions to Review</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                        <h3>Total Students</h3>
                        <div class="stat-number"><?= array_sum(array_column($teacher_features['my_courses'], 'students')) ?></div>
                        <p class="mt-2">Students Enrolled</p>
                    </div>
                </div>
            <?php elseif ($user['role'] === 'student' && isset($student_features)): ?>
                <!-- Student Stats -->
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-book fa-3x"></i>
                        </div>
                        <h3>Courses</h3>
                        <div class="stat-number"><?= count($student_features['my_courses']) ?></div>
                        <p class="mt-2">Enrolled Courses</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-tasks fa-3x"></i>
                        </div>
                        <h3>Lessons</h3>
                        <div class="stat-number">0</div>
                        <p class="mt-2">Completed Lessons</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-clipboard-check fa-3x"></i>
                        </div>
                        <h3>Quizzes</h3>
                        <div class="stat-number"><?= count($student_features['recent_grades']) ?></div>
                        <p class="mt-2">Grades Received</p>
                    </div>
                </div>
            <?php else: ?>
                <!-- Default Stats -->
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-book fa-3x"></i>
                        </div>
                        <h3>Courses</h3>
                        <div class="stat-number">0</div>
                        <p class="mt-2">Enrolled Courses</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-tasks fa-3x"></i>
                        </div>
                        <h3>Lessons</h3>
                        <div class="stat-number">0</div>
                        <p class="mt-2">Completed Lessons</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-clipboard-check fa-3x"></i>
                        </div>
                        <h3>Quizzes</h3>
                        <div class="stat-number">0</div>
                        <p class="mt-2">Quizzes Taken</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Role-based Quick Actions -->
        <div class="glass-card mb-4">
            <div class="card-body p-4">
                <h3 class="h5 mb-4 text-white"><i class="fas fa-bolt me-2"></i>Quick Actions</h3>
                <div class="row g-3">
                    <?php if ($user['role'] === 'admin'): ?>
                        <!-- Admin Actions -->
                        <div class="col-6 col-md-3">
                            <a href="#" class="btn btn-outline-custom w-100 py-3">
                                <i class="fas fa-users-cog me-2"></i>Manage Users
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="#" class="btn btn-custom w-100 py-3">
                                <i class="fas fa-chart-bar me-2"></i>Analytics
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="#" class="btn btn-outline-custom w-100 py-3">
                                <i class="fas fa-cogs me-2"></i>Settings
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="#" class="btn btn-outline-custom w-100 py-3">
                                <i class="fas fa-file-alt me-2"></i>Reports
                            </a>
                        </div>
                    <?php elseif ($user['role'] === 'teacher'): ?>
                        <!-- Teacher Actions -->
                        <div class="col-6 col-md-3">
                            <a href="#" class="btn btn-outline-custom w-100 py-3">
                                <i class="fas fa-chalkboard me-2"></i>My Courses
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="#" class="btn btn-custom w-100 py-3">
                                <i class="fas fa-clipboard-list me-2"></i>Grade Submissions
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="#" class="btn btn-outline-custom w-100 py-3">
                                <i class="fas fa-plus-circle me-2"></i>Create Lesson
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="#" class="btn btn-outline-custom w-100 py-3">
                                <i class="fas fa-chart-line me-2"></i>Student Progress
                            </a>
                        </div>
                    <?php elseif ($user['role'] === 'student'): ?>
                        <!-- Student Actions -->
                        <div class="col-6 col-md-3">
                            <a href="#" class="btn btn-outline-custom w-100 py-3">
                                <i class="fas fa-search me-2"></i>Browse Courses
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="#" class="btn btn-custom w-100 py-3">
                                <i class="fas fa-play me-2"></i>Start Learning
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="#" class="btn btn-outline-custom w-100 py-3">
                                <i class="fas fa-question-circle me-2"></i>Take Quiz
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="#" class="btn btn-outline-custom w-100 py-3">
                                <i class="fas fa-user-edit me-2"></i>Edit Profile
                            </a>
                        </div>
                    <?php else: ?>
                        <!-- Default Actions -->
                        <div class="col-6 col-md-3">
                            <a href="#" class="btn btn-outline-custom w-100 py-3">
                                <i class="fas fa-search me-2"></i>Browse Courses
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="#" class="btn btn-custom w-100 py-3">
                                <i class="fas fa-play me-2"></i>Start Learning
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="#" class="btn btn-outline-custom w-100 py-3">
                                <i class="fas fa-question-circle me-2"></i>Take Quiz
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="#" class="btn btn-outline-custom w-100 py-3">
                                <i class="fas fa-user-edit me-2"></i>Edit Profile
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Role-based Recent Activity -->
        <div class="glass-card">
            <div class="card-body p-4">
                <h3 class="h5 mb-4 text-white"><i class="fas fa-history me-2"></i>Recent Activity</h3>
                
                <?php if ($user['role'] === 'admin' && isset($admin_features['recent_activities'])): ?>
                    <!-- Admin Activity -->
                    <div class="activity-list">
                        <?php foreach ($admin_features['recent_activities'] as $activity): ?>
                            <div class="activity-item d-flex align-items-center mb-3 p-3 rounded" style="background: rgba(255, 255, 255, 0.05);">
                                <i class="fas fa-info-circle me-3 text-info"></i>
                                <div>
                                    <div class="text-white"><?= $activity['action'] ?></div>
                                    <small class="text-white-50"><?= $activity['time'] ?></small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php elseif ($user['role'] === 'teacher' && isset($teacher_features['my_courses'])): ?>
                    <!-- Teacher Activity -->
                    <div class="activity-list">
                        <?php foreach ($teacher_features['my_courses'] as $course): ?>
                            <div class="activity-item d-flex align-items-center mb-3 p-3 rounded" style="background: rgba(255, 255, 255, 0.05);">
                                <i class="fas fa-chalkboard-teacher me-3 text-warning"></i>
                                <div>
                                    <div class="text-white">Managing: <?= $course['name'] ?></div>
                                    <small class="text-white-50"><?= $course['students'] ?> students enrolled</small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="activity-item d-flex align-items-center mb-3 p-3 rounded" style="background: rgba(255, 255, 255, 0.05);">
                            <i class="fas fa-clipboard-list me-3 text-danger"></i>
                            <div>
                                <div class="text-white"><?= $teacher_features['pending_submissions'] ?> submissions pending review</div>
                                <small class="text-white-50">Requires attention</small>
                            </div>
                        </div>
                    </div>
                <?php elseif ($user['role'] === 'student' && isset($student_features['my_courses'])): ?>
                    <!-- Student Activity -->
                    <div class="activity-list">
                        <?php foreach ($student_features['my_courses'] as $course): ?>
                            <div class="activity-item d-flex align-items-center mb-3 p-3 rounded" style="background: rgba(255, 255, 255, 0.05);">
                                <i class="fas fa-book me-3 text-success"></i>
                                <div>
                                    <div class="text-white">Enrolled in: <?= $course['name'] ?></div>
                                    <small class="text-white-50">Progress: <?= $course['progress'] ?>%</small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php foreach ($student_features['recent_grades'] as $grade): ?>
                            <div class="activity-item d-flex align-items-center mb-3 p-3 rounded" style="background: rgba(255, 255, 255, 0.05);">
                                <i class="fas fa-star me-3 text-warning"></i>
                                <div>
                                    <div class="text-white">Grade received: <?= $grade['assignment'] ?></div>
                                    <small class="text-white-50">Score: <?= $grade['grade'] ?>%</small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <!-- Default Activity -->
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-4x mb-3" style="color: rgba(255, 255, 255, 0.3);"></i>
                        <p class="text-white-50 mb-0">No recent activity to display.</p>
                        <p class="text-white-50">Start exploring courses to see your activity here!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="text-white mb-3">ITE311-LAYAN</h5>
                    <p class="mb-0">Empowering learners through innovative education technology.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="social-links mb-3">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                    </div>
                    <p class="mb-0">&copy; <?= date('Y') ?> ITE311-LAYAN. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
