<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <!-- Welcome Message -->
    <div class="card mb-4">
        <div class="card-header">
            <h4 class="mb-0">Welcome, <?= esc($user['name'] ?? 'User') ?>!</h4>
        </div>
        <div class="card-body">
            <p class="mb-0">You are logged in as: <span class="badge bg-primary"><?= esc(ucfirst($user['role'] ?? 'user')) ?></span></p>
        </div>
    </div>

    <!-- Role-based Content -->
    <?php if (($user['role'] ?? '') === 'admin'): ?>
        <!-- Admin Dashboard -->
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-users"></i> Users</h5>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center"><?= $stats['total_users'] ?? 0 ?></h3>
                        <p class="text-center mb-0">Total Users</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-chalkboard-teacher"></i> Teachers</h5>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center"><?= $stats['total_teachers'] ?? 0 ?></h3>
                        <p class="text-center mb-0">Total Teachers</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-user-graduate"></i> Students</h5>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center"><?= $stats['total_students'] ?? 0 ?></h3>
                        <p class="text-center mb-0">Total Students</p>
                    </div>
                </div>
            </div>
        </div>

    <?php elseif (($user['role'] ?? '') === 'teacher'): ?>
        <!-- Teacher Dashboard -->
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-book"></i> My Courses</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($courses)): ?>
                            <div class="list-group">
                                <?php foreach ($courses as $course): ?>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <?= esc($course['name'] ?? 'Untitled Course') ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">No courses assigned yet.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-calendar-alt"></i> Upcoming Classes</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($upcoming_classes)): ?>
                            <div class="list-group">
                                <?php foreach ($upcoming_classes as $class): ?>
                                    <div class="list-group-item">
                                        <h6 class="mb-1"><?= esc($class['title'] ?? 'Untitled Class') ?></h6>
                                        <small class="text-muted"><?= date('M j, Y h:i A', strtotime($class['date'] ?? 'now')) ?></small>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">No upcoming classes scheduled.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>
        <!-- Student Dashboard -->
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-book"></i> My Enrolled Courses</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($enrolled_courses)): ?>
                            <div class="list-group">
                                <?php foreach ($enrolled_courses as $course): ?>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <?= esc($course['name'] ?? 'Untitled Course') ?>
                                        <span class="badge bg-primary float-end"><?= $course['progress'] ?? 0 ?>%</span>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">You are not enrolled in any courses yet.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-tasks"></i> Upcoming Deadlines</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($upcoming_deadlines)): ?>
                            <div class="list-group">
                                <?php foreach ($upcoming_deadlines as $deadline): ?>
                                    <div class="list-group-item">
                                        <h6 class="mb-1"><?= esc($deadline['title'] ?? 'Untitled') ?></h6>
                                        <small class="text-muted">Due: <?= date('M j, Y', strtotime($deadline['due_date'] ?? 'now')) ?></small>
                                        <span class="badge bg-warning float-end"><?= $deadline['course'] ?? 'General' ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">No upcoming deadlines.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
            border-radius: 8px;
            overflow: hidden;
        }
        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: #2c2c2c;
        }
        .table thead th {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            border: none;
            color: #ecf0f1;
        }
        .text-muted {
            color: #95a5a6 !important;
        }
        .alert {
            border-radius: 8px;
            border: none;
        }
        .role-badge {
            font-size: 0.8em;
            padding: 0.25em 0.5em;
        }
        .stats-card {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            border: 2px solid #3498db;
            transition: all 0.3s ease;
        }
        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(52, 152, 219, 0.2);
        }
        .nav-tabs .nav-link.active {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            border-color: #3498db !important;
            color: #fff !important;
        }
        .nav-tabs .nav-link {
            border-radius: 8px 8px 0 0;
            color: #ecf0f1;
            border: 1px solid #444;
        }
        .nav-tabs .nav-link:hover {
            background: #333;
            border-color: #3498db;
        }
        .form-control {
            background: #2c2c2c;
            border: 2px solid #555;
            color: #ecf0f1;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            background: #333;
            border-color: #3498db;
            color: #ecf0f1;
        }
        .dropdown-menu {
            background: #1a1a1a;
            border: 2px solid #333;
            border-radius: 8px;
        }
        .dropdown-item {
            color: #ecf0f1;
        }
        .dropdown-item:hover {
            background: #3498db;
            color: #fff;
        }
        .dashboard-decoration {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 30%, rgba(52, 152, 219, 0.05) 0%, transparent 50%),
                        radial-gradient(circle at 80% 70%, rgba(155, 89, 182, 0.05) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }
    </style>
</head>
<body>
    <div class="dashboard-decoration"></div>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-chart-line me-2"></i>
                Professional Dashboard
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                        </a>
                    </li>
                    <?php if ($user_role === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#adminPanel" data-bs-toggle="tab">
                                <i class="fas fa-crown me-1"></i>Admin Panel
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#userManagement" data-bs-toggle="tab">
                                <i class="fas fa-users-cog me-1"></i>User Management
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($user_role === 'teacher'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#myCourses" data-bs-toggle="tab">
                                <i class="fas fa-book me-1"></i>My Courses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#students" data-bs-toggle="tab">
                                <i class="fas fa-graduation-cap me-1"></i>Students
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($user_role === 'user'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#myCourses" data-bs-toggle="tab">
                                <i class="fas fa-book me-1"></i>My Courses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#availableCourses" data-bs-toggle="tab">
                                <i class="fas fa-search me-1"></i>Browse Courses
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-2"></i>
                            <?= esc($user) ?>
                            <span class="badge bg-<?= $user_role === 'admin' ? 'danger' : ($user_role === 'teacher' ? 'warning' : 'info') ?> role-badge ms-2">
                                <?= strtoupper($user_role) ?>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user-edit me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= site_url('/auth/logout') ?>">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        <!-- Welcome Header -->
        <div class="card mb-4">
            <div class="card-body text-center py-4" style="background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);">
                <h2 class="mb-2">
                    <i class="fas fa-rocket me-2"></i>
                    Welcome to Your Professional Dashboard
                </h2>
                <p class="mb-0">
                    Hello, <strong class="text-info">PROFESSIONAL <?= esc(strtoupper($user)) ?></strong>
                    <span class="badge bg-<?= $user_role === 'admin' ? 'danger' : ($user_role === 'teacher' ? 'warning' : 'info') ?> ms-2">
                        <?= strtoupper($user_role) ?> ACCESS
                        <?= strtoupper($user_role) ?> CLASSIFICATION
                    </span>
                </p>
            </div>
        </div>

        <!-- Role-based Content Tabs -->
        <div class="tab-content" id="dashboardTabs">

            <!-- Admin Panel Tab -->
            <?php if ($user_role === 'admin'): ?>
            <div class="tab-pane fade show active" id="adminPanel">
                <div class="row mb-4">
                    <!-- Statistics Cards -->
                    <div class="col-md-3">
                        <div class="card stats-card text-white h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-users fa-3x mb-3 text-primary"></i>
                                <h5 class="card-title">TOTAL PERSONNEL</h5>
                                <h2 class="text-primary"><?= $role_stats['total_users'] ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card text-white h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-crown fa-3x mb-3 text-danger"></i>
                                <h5 class="card-title">COMMAND OFFICERS</h5>
                                <h2 class="text-danger"><?= $role_stats['admins'] ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card text-white h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-chalkboard-teacher fa-3x mb-3 text-warning"></i>
                                <h5 class="card-title">INSTRUCTORS</h5>
                                <h2 class="text-warning"><?= $role_stats['teachers'] ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card text-white h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-graduation-cap fa-3x mb-3 text-info"></i>
                                <h5 class="card-title">CADETS</h5>
                                <h2 class="text-info"><?= $role_stats['students'] ?></h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Courses -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-book-open me-2"></i>
                            RECENT MISSIONS
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php if (empty($recent_courses)): ?>
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                No missions deployed yet. <strong>Deploy your first course!</strong>
                            </div>
                        <?php else: ?>
                            <div class="row">
                                <?php foreach ($recent_courses as $course): ?>
                                    <div class="col-md-6 col-lg-4 mb-3">
                                        <div class="card h-100 border-primary">
                                            <div class="card-body">
                                                <h6 class="card-title">
                                                    <i class="fas fa-rocket me-2"></i>
                                                    <?= esc($course['title']) ?>
                                                </h6>
                                                <p class="card-text text-muted small">
                                                    <?= empty($course['description']) ? 'No mission briefing' : esc(substr($course['description'], 0, 100)) . '...' ?>
                                                </p>
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar me-1"></i>
                                                    Deployed: <?= date('M d, Y', strtotime($course['created_at'])) ?>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Teacher Panel Tab -->
            <?php if ($user_role === 'teacher'): ?>
            <div class="tab-pane fade show active" id="myCourses">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card stats-card text-white h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-book fa-3x mb-3 text-success"></i>
                                <h5 class="card-title">ACTIVE MISSIONS</h5>
                                <h2 class="text-success"><?= $course_count ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5><i class="fas fa-cogs me-2"></i>Command Actions</h5>
                                <button class="btn btn-primary me-2">
                                    <i class="fas fa-plus me-2"></i>Deploy New Mission
                                </button>
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-chart-bar me-2"></i>View Reports
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Teacher's Courses -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-book me-2"></i>
                            MY DEPLOYED MISSIONS
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php if (empty($my_courses)): ?>
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                No missions deployed yet.
                                <a href="#" class="text-decoration-none">
                                    <strong>Deploy your first mission now!</strong>
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="row">
                                <?php foreach ($my_courses as $course): ?>
                                    <div class="col-md-6 col-lg-4 mb-3">
                                        <div class="card h-100 border-warning">
                                            <div class="card-body">
                                                <h6 class="card-title">
                                                    <i class="fas fa-rocket me-2"></i>
                                                    <?= esc($course['title']) ?>
                                                </h6>
                                                <p class="card-text text-muted small">
                                                    <?= empty($course['description']) ? 'No mission briefing' : esc(substr($course['description'], 0, 100)) . '...' ?>
                                                </p>
                                                <div class="d-flex justify-content-between">
                                                    <small class="text-muted">
                                                        <i class="fas fa-calendar me-1"></i>
                                                        Deployed: <?= date('M d, Y', strtotime($course['created_at'])) ?>
                                                    </small>
                                                    <div>
                                                        <button class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-edit me-1"></i>Edit
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-danger">
                                                            <i class="fas fa-trash me-1"></i>Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Student Panel Tab -->
            <?php if ($user_role === 'user'): ?>
            <div class="tab-pane fade show active" id="myCourses">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card stats-card text-white h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-graduation-cap fa-3x mb-3 text-success"></i>
                                <h5 class="card-title">MISSIONS COMPLETED</h5>
                                <h2 class="text-success"><?= $enrollment_count ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5><i class="fas fa-search me-2"></i>Navigation</h5>
                                <button class="btn btn-primary" data-bs-toggle="tab" data-bs-target="#availableCourses">
                                    <i class="fas fa-binoculars me-2"></i>Explore New Missions
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Universal Courses Section -->
            <div class="tab-pane fade <?php echo ($user_role === 'admin' || $user_role === 'teacher') ? '' : 'show active'; ?>" id="<?php echo ($user_role === 'user') ? 'availableCourses' : 'courses'; ?>">
                <!-- Enrolled Courses (Students only) -->
                <?php if ($user_role === 'user' && !empty($enrolled_courses)): ?>
                <div class="card mb-4 border-success">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-trophy me-2"></i>
                            MISSIONS ACCOMPLISHED
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row" id="enrolled-courses-list">
                            <?php foreach ($enrolled_courses as $course): ?>
                                <div class="col-md-6 col-lg-4 mb-3" data-course-id="<?= $course['course_id'] ?>">
                                    <div class="card h-100 border-success">
                                        <div class="card-body">
                                            <h5 class="card-title text-success">
                                                <i class="fas fa-check-circle me-2"></i>
                                                <?= esc($course['title']) ?>
                                            </h5>
                                            <p class="card-text text-muted">
                                                <?= empty($course['description']) ? 'No mission briefing' : esc($course['description']) ?>
                                            </p>
                                            <small class="text-muted">
                                                <i class="fas fa-calendar-check me-1"></i>
                                                Completed: <?= date('M d, Y', strtotime($course['enrollment_date'] ?? $course['enrolled_at'] ?? 'now')) ?>
                                            </small>
                                            <div class="mt-2">
                                                <button class="btn btn-sm btn-outline-success">
                                                    <i class="fas fa-play me-1"></i>Continue Mission
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-times me-1"></i>Abort Mission
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Available Courses -->
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-binoculars me-2"></i>
                            AVAILABLE MISSIONS
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php if (empty($available_courses)): ?>
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                No missions available for deployment.
                                <?php if ($user_role === 'admin'): ?>
                                    <strong>Deploy a mission to begin operations!</strong>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <div class="row" id="available-courses-list">
                                <?php foreach ($available_courses as $course): ?>
                                    <div class="col-md-6 col-lg-4 mb-3" data-course-id="<?= $course['id'] ?>">
                                        <div class="card h-100 border-primary">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <i class="fas fa-rocket me-2"></i>
                                                    <?= esc($course['title']) ?>
                                                </h5>
                                                <p class="card-text text-muted">
                                                    <?= empty($course['description']) ? 'No mission briefing' : esc($course['description']) ?>
                                                </p>
                                                <?php if ($user_role === 'user'): ?>
                                                    <button class="btn btn-primary enroll-btn" data-course-id="<?= $course['id'] ?>">
                                                        <i class="fas fa-sign-in-alt me-2"></i>Begin Mission
                                                    </button>
                                                <?php elseif ($user_role === 'admin'): ?>
                                                    <div class="mt-2">
                                                        <button class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-edit me-1"></i>Edit
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-info">
                                                            <i class="fas fa-eye me-1"></i>View
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-danger">
                                                            <i class="fas fa-trash me-1"></i>Delete
                                                        </button>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- User Management (Admin only) -->
            <?php if ($user_role === 'admin'): ?>
            <div class="tab-pane fade" id="userManagement">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-users-cog me-2"></i>
                            PERSONNEL MANAGEMENT
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php if (empty($all_users)): ?>
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                No personnel in the system.
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-dark">
                                    <thead>
                                        <tr>
                                            <th><i class="fas fa-user me-1"></i>Name</th>
                                            <th><i class="fas fa-envelope me-1"></i>Email</th>
                                            <th><i class="fas fa-user-tag me-1"></i>Classification</th>
                                            <th><i class="fas fa-calendar me-1"></i>Joined</th>
                                            <th><i class="fas fa-cogs me-1"></i>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($all_users as $user): ?>
                                            <tr>
                                                <td>
                                                    <i class="fas fa-user-circle me-2 text-primary"></i>
                                                    <?= esc($user['name']) ?>
                                                </td>
                                                <td>
                                                    <i class="fas fa-envelope me-2 text-info"></i>
                                                    <?= esc($user['email']) ?>
                                                </td>
                                                <td>
                                                    <span class="badge bg-<?= $user['role'] === 'teacher' ? 'warning' : 'info' ?>">
                                                        <i class="fas fa-<?= $user['role'] === 'teacher' ? 'chalkboard-teacher' : 'graduation-cap' ?> me-1"></i>
                                                        <?= strtoupper($user['role']) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <i class="fas fa-calendar-check me-2 text-success"></i>
                                                    <?= date('M d, Y', strtotime($user['created_at'])) ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-edit me-1"></i>Edit
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash me-1"></i>Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

        </div>

        <!-- Success/Error Messages -->
        <div id="message-container"></div>
    </div>

    <!-- Course Enrollment Script (Students only) -->
    <?php if ($user_role === 'user'): ?>
    <script>
    $(document).ready(function() {
        $('.enroll-btn').click(function(e) {
            e.preventDefault();

            const button = $(this);
            const courseId = button.data('course-id');
            const courseCard = button.closest('.col-md-6, .col-lg-4');

            button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Deploying...');

            $.post('<?= site_url('/course/enroll') ?>', {
                course_id: courseId,
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            }, function(data) {
                if (data.success) {
                    $('#message-container').html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>${data.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    `);

                    // Move to enrolled section
                    const enrolledSection = $('#enrolled-courses-list');
                    if (enrolledSection.length === 0) {
                        $('.container-fluid .card.mb-4').after(`
                            <div class="card mb-4 border-success">
                                <div class="card-header bg-success text-white">
                                    <h4 class="mb-0"><i class="fas fa-trophy me-2"></i>MISSIONS ACCOMPLISHED</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row" id="enrolled-courses-list"></div>
                                </div>
                            </div>
                        `);
                    }

                    const enrolledCourseHtml = `
                        <div class="col-md-6 col-lg-4 mb-3" data-course-id="${courseId}">
                            <div class="card h-100 border-success">
                                <div class="card-body">
                                    <h5 class="card-title text-success">
                                        <i class="fas fa-check-circle me-2"></i>${courseCard.find('.card-title').text().replace(/<i[^>]*>.*?<\/i>/, '').trim()}
                                    </h5>
                                    <p class="card-text text-muted">${courseCard.find('.card-text').text()}</p>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar-check me-1"></i>
                                        Mission Start: ${new Date().toLocaleDateString()}
                                    </small>
                                    <div class="mt-2">
                                        <button class="btn btn-sm btn-outline-success">
                                            <i class="fas fa-play me-1"></i>Continue Mission
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-times me-1"></i>Abort Mission
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    $('#enrolled-courses-list').prepend(enrolledCourseHtml);
                    courseCard.fadeOut();
                } else {
                    $('#message-container').html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>${data.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    `);
                    button.prop('disabled', false).html('<i class="fas fa-sign-in-alt me-2"></i>Begin Mission');
                }
            }).fail(function() {
                $('#message-container').html(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>Mission deployment failed. Please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `);
                button.prop('disabled', false).html('<i class="fas fa-sign-in-alt me-2"></i>Begin Mission');
            });
        });
    });
    </script>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
