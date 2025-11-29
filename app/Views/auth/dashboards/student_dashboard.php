<?= $this->include('templates/header') ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Student Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <i class="fas fa-calendar-alt me-1"></i>
                This week
            </button>
        </div>
    </div>

    <!-- Welcome Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-light">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="card-title">Welcome back, <?= $user['name'] ?>!</h4>
                            <p class="card-text">You have 3 upcoming assignments and 2 new announcements.</p>
                            <a href="<?= base_url('student/courses') ?>" class="btn btn-primary">
                                <i class="fas fa-book me-1"></i> View My Courses
                            </a>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <img src="https://via.placeholder.com/200" alt="Student" class="img-fluid" style="max-height: 150px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body text-center">
                    <h6 class="card-subtitle mb-2 text-muted">Enrolled Courses</h6>
                    <h2 class="mb-0"><?= count($enrolled_courses ?? []) ?></h2>
                    <div class="mt-3">
                        <a href="<?= base_url('student/courses') ?>" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body text-center">
                    <h6 class="card-subtitle mb-2 text-muted">Assignments Due</h6>
                    <h2 class="mb-0">3</h2>
                    <div class="mt-3">
                        <a href="<?= base_url('student/assignments') ?>" class="btn btn-sm btn-warning">View All</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body text-center">
                    <h6 class="card-subtitle mb-2 text-muted">Average Grade</h6>
                    <h2 class="mb-0">A-</h2>
                    <div class="mt-3">
                        <a href="<?= base_url('student/grades') ?>" class="btn btn-sm btn-outline-success">View Grades</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body text-center">
                    <h6 class="card-subtitle mb-2 text-muted">Attendance</h6>
                    <h2 class="mb-0">95%</h2>
                    <div class="mt-3">
                        <a href="<?= base_url('student/attendance') ?>" class="btn btn-sm btn-outline-info">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Upcoming Assignments -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Upcoming Assignments</h5>
                    <a href="<?= base_url('student/assignments') ?>" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <?php for ($i = 1; $i <= 3; $i++): ?>
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Assignment <?= $i ?>: Web Development</h6>
                                    <span class="badge bg-<?= $i === 1 ? 'danger' : 'warning' ?> text-white">
                                        Due in <?= $i === 1 ? 'Tomorrow' : ($i === 2 ? '3 days' : '1 week') ?>
                                    </span>
                                </div>
                                <p class="mb-1">Complete the responsive design project</p>
                                <small class="text-muted">Course: Web Development 101</small>
                                <div class="mt-2">
                                    <a href="<?= base_url('student/assignments/1') ?>" class="btn btn-sm btn-outline-primary">View Details</a>
                                    <a href="<?= base_url('student/assignments/1/submit') ?>" class="btn btn-sm btn-success">
                                        <i class="fas fa-upload me-1"></i> Submit
                                    </a>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Announcements -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Recent Announcements</h5>
                    <a href="<?= base_url('student/announcements') ?>" class="btn btn-sm btn-outline-secondary">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex w-100">
                                <div class="me-3 text-primary">
                                    <i class="fas fa-bullhorn fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Class Cancellation - Web Development</h6>
                                    <p class="mb-1">The class scheduled for Friday has been cancelled. Please check the course page for updates.</p>
                                    <small class="text-muted">Posted by Prof. Smith, 2 hours ago</small>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex w-100">
                                <div class="me-3 text-warning">
                                    <i class="fas fa-exclamation-triangle fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Assignment Deadline Extended</h6>
                                    <p class="mb-1">The deadline for the Database project has been extended to next Monday.</p>
                                    <small class="text-muted">Posted by Dr. Johnson, 1 day ago</small>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex w-100">
                                <div class="me-3 text-success">
                                    <i class="fas fa-calendar-plus fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Guest Lecture Announcement</h6>
                                    <p class="mb-1">We're excited to announce a guest lecture on AI in Web Development next week.</p>
                                    <small class="text-muted">Posted by Prof. Williams, 2 days ago</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Quick Links</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-2 col-4 text-center">
                            <a href="<?= base_url('student/courses') ?>" class="text-decoration-none">
                                <div class="p-3 border rounded">
                                    <i class="fas fa-book fa-2x text-primary mb-2"></i>
                                    <div>My Courses</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2 col-4 text-center">
                            <a href="<?= base_url('student/schedule') ?>" class="text-decoration-none">
                                <div class="p-3 border rounded">
                                    <i class="fas fa-calendar-alt fa-2x text-success mb-2"></i>
                                    <div>Class Schedule</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2 col-4 text-center">
                            <a href="<?= base_url('student/grades') ?>" class="text-decoration-none">
                                <div class="p-3 border rounded">
                                    <i class="fas fa-chart-line fa-2x text-warning mb-2"></i>
                                    <div>Grades</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2 col-4 text-center">
                            <a href="<?= base_url('student/resources') ?>" class="text-decoration-none">
                                <div class="p-3 border rounded">
                                    <i class="fas fa-folder-open fa-2x text-info mb-2"></i>
                                    <div>Resources</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2 col-4 text-center">
                            <a href="<?= base_url('student/discussions') ?>" class="text-decoration-none">
                                <div class="p-3 border rounded">
                                    <i class="fas fa-comments fa-2x text-purple mb-2"></i>
                                    <div>Discussions</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2 col-4 text-center">
                            <a href="<?= base_url('student/profile') ?>" class="text-decoration-none">
                                <div class="p-3 border rounded">
                                    <i class="fas fa-user-cog fa-2x text-secondary mb-2"></i>
                                    <div>Profile</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('templates/footer') ?>
