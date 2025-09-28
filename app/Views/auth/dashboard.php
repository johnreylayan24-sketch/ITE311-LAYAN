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
        
        body {
            background: var(--primary-gradient);
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
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
        }

        .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid var(--glass-border);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .btn-glass {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            color: white;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-glass:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            color: white;
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
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/') ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/about') ?>">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/contact') ?>">Contact</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i><?= esc($user['name']) ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= base_url('/logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
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

        <div class="row">
            <div class="col-lg-8">
                <div class="glass-card mb-4">
                    <div class="card-body p-4">
                        <h2 class="h3 mb-4 text-white">
                            <i class="fas fa-tachometer-alt me-2"></i>Welcome to Your Dashboard
                        </h2>
                        
                        <!-- Role-based Header Statistics -->
                        <?php if ($user['role'] === 'admin' && isset($admin_features)): ?>
                            <div class="d-flex justify-content-end mb-4">
                                <div class="text-center me-3">
                                    <h3 class="stat-number text-white"><?= $admin_features['total_users'] ?></h3>
                                    <p class="mb-0 text-white-50">Total Users</p>
                                </div>
                                <div class="text-center me-3">
                                    <h3 class="stat-number text-white"><?= $admin_features['total_admins'] ?></h3>
                                    <p class="mb-0 text-white-50">Admins</p>
                                </div>
                                <div class="text-center me-3">
                                    <h3 class="stat-number text-white"><?= $admin_features['total_teachers'] ?></h3>
                                    <p class="mb-0 text-white-50">Teachers</p>
                                </div>
                                <div class="text-center">
                                    <h3 class="stat-number text-white"><?= $admin_features['total_students'] ?></h3>
                                    <p class="mb-0 text-white-50">Students</p>
                                </div>
                            </div>
                        <?php elseif ($user['role'] === 'teacher' && isset($teacher_features)): ?>
                            <div class="d-flex justify-content-end mb-4">
                                <div class="text-center me-3">
                                    <h3 class="stat-number text-white"><?= $teacher_features['total_courses'] ?></h3>
                                    <p class="mb-0 text-white-50">Courses</p>
                                </div>
                                <div class="text-center me-3">
                                    <h3 class="stat-number text-white"><?= $teacher_features['total_students'] ?></h3>
                                    <p class="mb-0 text-white-50">Students</p>
                                </div>
                                <div class="text-center me-3">
                                    <h3 class="stat-number text-white"><?= $teacher_features['total_assignments'] ?></h3>
                                    <p class="mb-0 text-white-50">Assignments</p>
                                </div>
                                <div class="text-center">
                                    <h3 class="stat-number text-white"><?= $teacher_features['pending_submissions'] ?></h3>
                                    <p class="mb-0 text-white-50">Pending</p>
                                </div>
                            </div>
                        <?php elseif ($user['role'] === 'student' && isset($student_features)): ?>
                            <div class="d-flex justify-content-end mb-4">
                                <div class="text-center me-3">
                                    <h3 class="stat-number text-white"><?= $student_features['enrolled_courses'] ?></h3>
                                    <p class="mb-0 text-white-50">Courses</p>
                                </div>
                                <div class="text-center me-3">
                                    <h3 class="stat-number text-white"><?= $student_features['completed_assignments'] ?></h3>
                                    <p class="mb-0 text-white-50">Completed</p>
                                </div>
                                <div class="text-center me-3">
                                    <h3 class="stat-number text-white"><?= $student_features['pending_assignments'] ?></h3>
                                    <p class="mb-0 text-white-50">Pending</p>
                                </div>
                                <div class="text-center">
                                    <h3 class="stat-number text-white"><?= $student_features['average_grade'] ?></h3>
                                    <p class="mb-0 text-white-50">Avg Grade</p>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="text-white">
                            <?php if ($user['role'] === 'admin'): ?>
                                <p class="lead">Hello, <strong><?= esc($user['name']) ?></strong>!</p>
                                <p>Welcome to your Admin Dashboard. You have full system access and can manage all users, courses, and system settings.</p>
                            <?php elseif ($user['role'] === 'teacher'): ?>
                                <p class="lead">Hello, <strong><?= esc($user['name']) ?></strong>!</p>
                                <p>Welcome to your Teacher Dashboard. You can manage your courses, assignments, and track student progress.</p>
                            <?php elseif ($user['role'] === 'student'): ?>
                                <p class="lead">Hello, <strong><?= esc($user['name']) ?></strong>!</p>
                                <p>Welcome to your Student Dashboard. You can view your courses, submit assignments, and track your grades.</p>
                            <?php else: ?>
                                <p class="lead">Hello, <strong><?= esc($user['name']) ?></strong>!</p>
                                <p>You are successfully logged in to the ITE311-LAYAN system.</p>
                            <?php endif; ?>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="glass-card p-3 mb-3">
                                        <h5 class="text-white"><i class="fas fa-envelope me-2"></i>Email</h5>
                                        <p class="mb-0"><?= esc($user['email']) ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="glass-card p-3 mb-3">
                                        <h5 class="text-white"><i class="fas fa-user-tag me-2"></i>Role</h5>
                                        <p class="mb-0"><?= esc($user['role'] ?? 'User') ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Role-based Stats Cards -->
                <div class="glass-card mb-4">
                    <div class="card-body p-4">
                        <h3 class="h5 mb-4 text-white"><i class="fas fa-chart-bar me-2"></i>Statistics Overview</h3>
                        <div class="row">
                            <?php if ($user['role'] === 'admin' && isset($admin_features)): ?>
                                <div class="col-md-3">
                                    <div class="stat-card text-center p-3">
                                        <div class="stat-icon mb-3 text-primary"><i class="fas fa-users fa-3x"></i></div>
                                        <h5 class="text-white">Total Users</h5>
                                        <div class="stat-number h2 text-white mb-2"><?= $admin_features['total_users'] ?></div>
                                        <p class="text-white-50 mb-0">Registered Users</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-card text-center p-3">
                                        <div class="stat-icon mb-3 text-success"><i class="fas fa-chalkboard-teacher fa-3x"></i></div>
                                        <h5 class="text-white">Active Teachers</h5>
                                        <div class="stat-number h2 text-white mb-2"><?= $admin_features['total_teachers'] ?></div>
                                        <p class="text-white-50 mb-0">Teaching Staff</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-card text-center p-3">
                                        <div class="stat-icon mb-3 text-info"><i class="fas fa-user-graduate fa-3x"></i></div>
                                        <h5 class="text-white">Total Students</h5>
                                        <div class="stat-number h2 text-white mb-2"><?= $admin_features['total_students'] ?></div>
                                        <p class="text-white-50 mb-0">Enrolled Students</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-card text-center p-3">
                                        <div class="stat-icon mb-3 text-warning"><i class="fas fa-book fa-3x"></i></div>
                                        <h5 class="text-white">Total Courses</h5>
                                        <div class="stat-number h2 text-white mb-2"><?= $admin_features['total_courses'] ?></div>
                                        <p class="text-white-50 mb-0">Available Courses</p>
                                    </div>
                                </div>
                            <?php elseif ($user['role'] === 'teacher' && isset($teacher_features)): ?>
                                <div class="col-md-3">
                                    <div class="stat-card text-center p-3">
                                        <div class="stat-icon mb-3 text-primary"><i class="fas fa-book-open fa-3x"></i></div>
                                        <h5 class="text-white">My Courses</h5>
                                        <div class="stat-number h2 text-white mb-2"><?= $teacher_features['total_courses'] ?></div>
                                        <p class="text-white-50 mb-0">Active Courses</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-card text-center p-3">
                                        <div class="stat-icon mb-3 text-success"><i class="fas fa-user-graduate fa-3x"></i></div>
                                        <h5 class="text-white">My Students</h5>
                                        <div class="stat-number h2 text-white mb-2"><?= $teacher_features['total_students'] ?></div>
                                        <p class="text-white-50 mb-0">Total Enrolled</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-card text-center p-3">
                                        <div class="stat-icon mb-3 text-info"><i class="fas fa-tasks fa-3x"></i></div>
                                        <h5 class="text-white">Assignments</h5>
                                        <div class="stat-number h2 text-white mb-2"><?= $teacher_features['total_assignments'] ?></div>
                                        <p class="text-white-50 mb-0">Created</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-card text-center p-3">
                                        <div class="stat-icon mb-3 text-warning"><i class="fas fa-clock fa-3x"></i></div>
                                        <h5 class="text-white">Pending</h5>
                                        <div class="stat-number h2 text-white mb-2"><?= $teacher_features['pending_submissions'] ?></div>
                                        <p class="text-white-50 mb-0">Submissions</p>
                                    </div>
                                </div>
                            <?php elseif ($user['role'] === 'student' && isset($student_features)): ?>
                                <div class="col-md-3">
                                    <div class="stat-card text-center p-3">
                                        <div class="stat-icon mb-3 text-primary"><i class="fas fa-book fa-3x"></i></div>
                                        <h5 class="text-white">Enrolled</h5>
                                        <div class="stat-number h2 text-white mb-2"><?= $student_features['enrolled_courses'] ?></div>
                                        <p class="text-white-50 mb-0">Courses</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-card text-center p-3">
                                        <div class="stat-icon mb-3 text-success"><i class="fas fa-check-circle fa-3x"></i></div>
                                        <h5 class="text-white">Completed</h5>
                                        <div class="stat-number h2 text-white mb-2"><?= $student_features['completed_assignments'] ?></div>
                                        <p class="text-white-50 mb-0">Assignments</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-card text-center p-3">
                                        <div class="stat-icon mb-3 text-info"><i class="fas fa-hourglass-half fa-3x"></i></div>
                                        <h5 class="text-white">Pending</h5>
                                        <div class="stat-number h2 text-white mb-2"><?= $student_features['pending_assignments'] ?></div>
                                        <p class="text-white-50 mb-0">Assignments</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-card text-center p-3">
                                        <div class="stat-icon mb-3 text-warning"><i class="fas fa-star fa-3x"></i></div>
                                        <h5 class="text-white">Average</h5>
                                        <div class="stat-number h2 text-white mb-2"><?= $student_features['average_grade'] ?></div>
                                        <p class="text-white-50 mb-0">Grade</p>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="col-12 text-center py-4">
                                    <i class="fas fa-chart-bar fa-3x mb-3 text-white-50"></i>
                                    <p class="text-white-50">No statistics available for your role.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="glass-card">
                    <div class="card-body p-4">
                        <h3 class="h5 mb-4 text-white"><i class="fas fa-history me-2"></i>Recent Activities</h3>
                        
                        <?php if ($user['role'] === 'admin' && isset($admin_features)): ?>
                            <div class="activity-list">
                                <?php if (!empty($admin_features['recent_users'])): ?>
                                    <?php foreach ($admin_features['recent_users'] as $recent_user): ?>
                                        <div class="activity-item mb-3 p-3 glass-card">
                                            <div class="d-flex align-items-center">
                                                <div class="activity-icon me-3">
                                                    <i class="fas fa-user-plus fa-2x text-primary"></i>
                                                </div>
                                                <div class="activity-content flex-grow-1">
                                                    <p class="mb-1 text-white">New user registered: <strong><?= esc($recent_user['name']) ?></strong> (<?= esc($recent_user['role']) ?>)</p>
                                                    <small class="text-white-50"><?= date('M j, Y g:i A', strtotime($recent_user['created_at'])) ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="text-center py-4">
                                        <i class="fas fa-users fa-3x mb-3 text-white-50"></i>
                                        <p class="text-white-50">No recent user registrations.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php elseif ($user['role'] === 'teacher' && isset($teacher_features)): ?>
                            <div class="activity-list">
                                <?php if (!empty($teacher_features['recent_courses'])): ?>
                                    <?php foreach ($teacher_features['recent_courses'] as $course): ?>
                                        <div class="activity-item mb-3 p-3 glass-card">
                                            <div class="d-flex align-items-center">
                                                <div class="activity-icon me-3">
                                                    <i class="fas fa-book-open fa-2x text-success"></i>
                                                </div>
                                                <div class="activity-content flex-grow-1">
                                                    <p class="mb-1 text-white">Teaching course: <strong><?= esc($course['course_name']) ?></strong></p>
                                                    <small class="text-white-50"><?= esc($course['student_count']) ?> students enrolled</small>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                
                                <?php if (!empty($teacher_features['pending_submissions_list'])): ?>
                                    <?php foreach ($teacher_features['pending_submissions_list'] as $submission): ?>
                                        <div class="activity-item mb-3 p-3 glass-card">
                                            <div class="d-flex align-items-center">
                                                <div class="activity-icon me-3">
                                                    <i class="fas fa-clock fa-2x text-warning"></i>
                                                </div>
                                                <div class="activity-content flex-grow-1">
                                                    <p class="mb-1 text-white">Pending submission: <strong><?= esc($submission['assignment_title']) ?></strong></p>
                                                    <small class="text-white-50">Student: <?= esc($submission['student_name']) ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                
                                <?php if (empty($teacher_features['recent_courses']) && empty($teacher_features['pending_submissions_list'])): ?>
                                    <div class="text-center py-4">
                                        <i class="fas fa-chalkboard-teacher fa-3x mb-3 text-white-50"></i>
                                        <p class="text-white-50">No recent teaching activities.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php elseif ($user['role'] === 'student' && isset($student_features)): ?>
                            <div class="activity-list">
                                <?php if (!empty($student_features['recent_courses'])): ?>
                                    <?php foreach ($student_features['recent_courses'] as $course): ?>
                                        <div class="activity-item mb-3 p-3 glass-card">
                                            <div class="d-flex align-items-center">
                                                <div class="activity-icon me-3">
                                                    <i class="fas fa-book fa-2x text-info"></i>
                                                </div>
                                                <div class="activity-content flex-grow-1">
                                                    <p class="mb-1 text-white">Enrolled in course: <strong><?= esc($course['course_name']) ?></strong></p>
                                                    <small class="text-white-50">Teacher: <?= esc($course['teacher_name']) ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                
                                <?php if (!empty($student_features['recent_grades'])): ?>
                                    <?php foreach ($student_features['recent_grades'] as $grade): ?>
                                        <div class="activity-item mb-3 p-3 glass-card">
                                            <div class="d-flex align-items-center">
                                                <div class="activity-icon me-3">
                                                    <i class="fas fa-star fa-2x text-warning"></i>
                                                </div>
                                                <div class="activity-content flex-grow-1">
                                                    <p class="mb-1 text-white">Grade received: <strong><?= esc($grade['grade']) ?></strong> for <?= esc($grade['assignment_title']) ?></p>
                                                    <small class="text-white-50"><?= date('M j, Y', strtotime($grade['graded_at'])) ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                
                                <?php if (empty($student_features['recent_courses']) && empty($student_features['recent_grades'])): ?>
                                    <div class="text-center py-4">
                                        <i class="fas fa-user-graduate fa-3x mb-3 text-white-50"></i>
                                        <p class="text-white-50">No recent student activities.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-4">
                                <i class="fas fa-history fa-3x mb-3 text-white-50"></i>
                                <p class="text-white-50">No recent activities to display.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="glass-card mb-4">
                    <div class="card-body p-4">
                        <h4 class="h5 mb-4 text-white"><i class="fas fa-bolt me-2"></i>Quick Actions</h4>
                        
                        <?php if ($user['role'] === 'admin' && isset($quick_actions)): ?>
                            <div class="row g-2">
                                <?php foreach ($quick_actions as $action): ?>
                                    <div class="col-6">
                                        <a href="<?= esc($action['url']) ?>" class="btn <?= $action['primary'] ? 'btn-glass' : 'btn-outline-glass' ?> w-100 py-2 text-center">
                                            <i class="fas fa-<?= esc($action['icon']) ?> me-1"></i>
                                            <span class="d-block small"><?= esc($action['label']) ?></span>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php elseif ($user['role'] === 'teacher' && isset($quick_actions)): ?>
                            <div class="row g-2">
                                <?php foreach ($quick_actions as $action): ?>
                                    <div class="col-6">
                                        <a href="<?= esc($action['url']) ?>" class="btn <?= $action['primary'] ? 'btn-glass' : 'btn-outline-glass' ?> w-100 py-2 text-center">
                                            <i class="fas fa-<?= esc($action['icon']) ?> me-1"></i>
                                            <span class="d-block small"><?= esc($action['label']) ?></span>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php elseif ($user['role'] === 'student' && isset($quick_actions)): ?>
                            <div class="row g-2">
                                <?php foreach ($quick_actions as $action): ?>
                                    <div class="col-6">
                                        <a href="<?= esc($action['url']) ?>" class="btn <?= $action['primary'] ? 'btn-glass' : 'btn-outline-glass' ?> w-100 py-2 text-center">
                                            <i class="fas fa-<?= esc($action['icon']) ?> me-1"></i>
                                            <span class="d-block small"><?= esc($action['label']) ?></span>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="d-grid gap-2">
                                <a href="#" class="btn btn-glass">
                                    <i class="fas fa-edit me-2"></i>Edit Profile
                                </a>
                                <a href="#" class="btn btn-glass">
                                    <i class="fas fa-key me-2"></i>Change Password
                                </a>
                                <a href="<?= base_url('/logout') ?>" class="btn btn-glass">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Notifications Section -->
                <div class="glass-card mb-4">
                    <div class="card-body p-4">
                        <h4 class="h5 mb-4 text-white"><i class="fas fa-bell me-2"></i>Notifications</h4>
                        <div class="notifications-container">
                            <?php if (!empty($notifications)): ?>
                                <?php foreach ($notifications as $notification): ?>
                                    <div class="alert alert-<?= $notification['type'] ?? 'info' ?> alert-dismissible fade show mb-3" role="alert" style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); color: white;">
                                        <div class="d-flex align-items-start">
                                            <i class="fas fa-<?= $notification['icon'] ?? 'info-circle' ?> me-2 mt-1"></i>
                                            <div class="flex-grow-1">
                                                <?= esc($notification['message']) ?>
                                                <small class="d-block mt-1 text-white-50"><?= date('M j, Y g:i A', strtotime($notification['created_at'])) ?></small>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center py-4">
                                    <i class="fas fa-bell-slash fa-3x mb-3" style="color: rgba(255, 255, 255, 0.3);"></i>
                                    <p class="text-white-50 mb-0">No new notifications</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="glass-card">
                    <div class="card-body p-4">
                        <h4 class="h5 mb-4 text-white"><i class="fas fa-info-circle me-2"></i>System Info</h4>
                        <ul class="list-unstyled text-white">
                            <li class="mb-2"><i class="fas fa-check me-2 text-success"></i>System Status: Online</li>
                            <li class="mb-2"><i class="fas fa-clock me-2"></i>Last Login: <?= date('M d, Y H:i') ?></li>
                            <li class="mb-2"><i class="fas fa-shield-alt me-2"></i>Security: Enabled</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <span class="text-white">© 2025 ITE311-LAYAN. All rights reserved.</span>
        </div>
    </footer>
</body>
</html>
