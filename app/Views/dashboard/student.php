<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Professional LMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            min-height: 100vh;
            background: #1cc88a;
            color: white;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            margin: 5px 0;
            border-radius: 5px;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }
        .sidebar .nav-link i {
            margin-right: 10px;
        }
        .main-content {
            padding: 20px;
        }
        .card-dashboard {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            transition: transform 0.3s;
        }
        .card-dashboard:hover {
            transform: translateY(-5px);
        }
        .welcome-header {
            background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .progress {
            height: 10px;
            border-radius: 5px;
        }
        .course-card {
            border-left: 4px solid #1cc88a;
            transition: all 0.3s;
        }
        .course-card:hover {
            transform: translateX(5px);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4>LMS Student</h4>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="/dashboard/student">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-book"></i> My Courses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-tasks"></i> Assignments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-chart-line"></i> Progress
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link text-white" href="/auth/logout">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                    <h1 class="h2">Student Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button class="btn btn-success">
                            <i class="fas fa-plus me-1"></i> Enroll in Course
                        </button>
                    </div>
                </div>

                <!-- Welcome Card -->
                <div class="welcome-header">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4>Welcome back, <?= esc($user_name) ?>!</h4>
                            <p class="mb-0">Continue your learning journey.</p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="bg-white text-dark d-inline-block px-3 py-2 rounded">
                                <small class="text-muted d-block">Learning Progress</small>
                                <div class="progress my-1" style="height: 8px;">
                                    <div class="progress-bar bg-success" style="width: 65%"></div>
                                </div>
                                <small>65% of monthly goal</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-dashboard bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title">Enrolled Courses</h6>
                                        <h2 class="mb-0">5</h2>
                                    </div>
                                    <i class="fas fa-book fa-3x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-dashboard bg-warning text-dark">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title">Pending Assignments</h6>
                                        <h2 class="mb-0">3</h2>
                                    </div>
                                    <i class="fas fa-tasks fa-3x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-dashboard bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title">Completed Courses</h6>
                                        <h2 class="mb-0">2</h2>
                                    </div>
                                    <i class="fas fa-trophy fa-3x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- My Courses -->
                <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">My Courses</h5>
                                <a href="#" class="btn btn-sm btn-outline-success">View All</a>
                            </div>
                            <div class="card-body">
                                <?php if (!empty($enrollments)): ?>
                                    <?php foreach ($enrollments as $course): ?>
                                    <div class="card mb-3 course-card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <div class="ratio ratio-16x9 bg-light rounded">
                                                        <div class="d-flex align-items-center justify-content-center text-muted">
                                                            <i class="fas fa-book fa-3x"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5 class="card-title mb-1"><?= esc($course['title']) ?></h5>
                                                    <p class="text-muted small mb-2">Instructor: <?= esc($course['instructor'] ?? 'N/A') ?></p>
                                                    <div class="progress mb-2" style="height: 8px;">
                                                        <div class="progress-bar bg-success" style="width: <?= rand(30, 90) ?>%"></div>
                                                    </div>
                                                    <p class="small mb-0">Progress: <?= rand(30, 90) ?>%</p>
                                                </div>
                                                <div class="col-md-3 text-md-end mt-3 mt-md-0">
                                                    <a href="#" class="btn btn-sm btn-success">Continue</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="text-center py-4">
                                        <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                                        <h5>No courses enrolled yet</h5>
                                        <p class="text-muted">Browse our catalog and enroll in courses to get started.</p>
                                        <a href="#" class="btn btn-success">Browse Courses</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Upcoming Deadlines -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Upcoming Deadlines</h5>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <?php
                                    $deadlines = [
                                        ['title' => 'Web Development Project', 'course' => 'CS101', 'due' => 'Tomorrow', 'type' => 'assignment'],
                                        ['title' => 'Quiz: JavaScript Basics', 'course' => 'JS201', 'due' => 'In 2 days', 'type' => 'quiz'],
                                        ['title' => 'Database Design Task', 'course' => 'DB301', 'due' => 'In 3 days', 'type' => 'assignment'],
                                    ];
                                    foreach ($deadlines as $item):
                                    ?>
                                    <div class="list-group-item px-0">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="bg-light rounded-circle p-2 text-center" style="width: 40px; height: 40px;">
                                                    <i class="fas fa-<?= $item['type'] === 'quiz' ? 'question-circle' : 'file-alt' ?> text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0"><?= $item['title'] ?></h6>
                                                <small class="text-muted"><?= $item['course'] ?> • Due <?= $item['due'] ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <a href="#" class="btn btn-outline-success w-100 mt-3">View All Deadlines</a>
                            </div>
                        </div>

                        <!-- Recommended Courses -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="mb-0">Recommended for You</h5>
                            </div>
                            <div class="card-body">
                                <?php if (!empty($courses)): ?>
                                    <?php foreach (array_slice($courses, 0, 3) as $course): ?>
                                    <div class="d-flex mb-3">
                                        <div class="flex-shrink-0">
                                            <div class="bg-light rounded" style="width: 60px; height: 60px;">
                                                <div class="h-100 d-flex align-items-center justify-content-center text-muted">
                                                    <i class="fas fa-book"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0"><?= esc($course['title']) ?></h6>
                                            <small class="text-muted"><?= $course['instructor'] ?? 'Instructor' ?></small><br>
                                            <small class="text-success">
                                                <i class="fas fa-star"></i> 4.5 (120)
                                            </small>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                    <a href="#" class="btn btn-outline-success w-100 mt-2">Browse All Courses</a>
                                <?php else: ?>
                                    <p class="text-muted small">Complete your profile to get personalized course recommendations.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
