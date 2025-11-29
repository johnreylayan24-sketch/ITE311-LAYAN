<?= $this->include('templates/header') ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Teacher Dashboard</h1>
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
                            <p class="card-text">Here's what's happening with your classes today.</p>
                            <a href="<?= base_url('teacher/courses') ?>" class="btn btn-primary">
                                <i class="fas fa-book me-1"></i> View My Courses
                            </a>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <img src="https://via.placeholder.com/200" alt="Teacher" class="img-fluid" style="max-height: 150px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2 text-muted">Active Courses</h6>
                            <h2 class="mb-0"><?= count($courses ?? []) ?></h2>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="fas fa-book fa-2x text-primary"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="<?= base_url('teacher/courses') ?>" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2 text-muted">Assignments to Grade</h6>
                            <h2 class="mb-0">12</h2>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded">
                            <i class="fas fa-tasks fa-2x text-warning"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="<?= base_url('teacher/assignments') ?>" class="btn btn-sm btn-outline-warning">Grade Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2 text-muted">Upcoming Classes</h6>
                            <h2 class="mb-0">3</h2>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded">
                            <i class="fas fa-calendar-alt fa-2x text-info"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="<?= base_url('teacher/schedule') ?>" class="btn btn-sm btn-outline-info">View Schedule</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Classes -->
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Upcoming Classes</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <?php for ($i = 1; $i <= 3; $i++): ?>
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Course Title <?= $i ?></h6>
                                    <small class="text-muted">Today, 2:00 PM</small>
                                </div>
                                <p class="mb-1">Introduction to Advanced Topics</p>
                                <small class="text-muted">Room 20<?= $i ?></small>
                            </div>
                        <?php endfor; ?>
                    </div>
                    <div class="text-center mt-3">
                        <a href="<?= base_url('teacher/schedule') ?>" class="btn btn-sm btn-outline-primary">View Full Schedule</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Recent Activity</h5>
                    <a href="#" class="btn btn-sm btn-outline-secondary">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex w-100">
                                <div class="me-3 text-primary">
                                    <i class="fas fa-file-upload fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">New Assignment Uploaded</h6>
                                    <p class="mb-1">You've uploaded a new assignment for Web Development 101</p>
                                    <small class="text-muted">2 hours ago</small>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex w-100">
                                <div class="me-3 text-success">
                                    <i class="fas fa-comment-dots fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">New Message</h6>
                                    <p class="mb-1">John Doe sent you a message about the project</p>
                                    <small class="text-muted">5 hours ago</small>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex w-100">
                                <div class="me-3 text-warning">
                                    <i class="fas fa-tasks fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Grading Reminder</h6>
                                    <p class="mb-1">You have 5 ungraded assignments in Database Systems</p>
                                    <small class="text-muted">1 day ago</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3 col-6">
                            <a href="<?= base_url('teacher/assignments/create') ?>" class="btn btn-outline-primary w-100">
                                <i class="fas fa-plus-circle me-2"></i> Create Assignment
                            </a>
                        </div>
                        <div class="col-md-3 col-6">
                            <a href="<?= base_url('teacher/announcements/create') ?>" class="btn btn-outline-success w-100">
                                <i class="fas fa-bullhorn me-2"></i> Post Announcement
                            </a>
                        </div>
                        <div class="col-md-3 col-6">
                            <a href="<?= base_url('teacher/grades') ?>" class="btn btn-outline-warning w-100">
                                <i class="fas fa-graduation-cap me-2"></i> Enter Grades
                            </a>
                        </div>
                        <div class="col-md-3 col-6">
                            <a href="<?= base_url('teacher/profile') ?>" class="btn btn-outline-info w-100">
                                <i class="fas fa-user-edit me-2"></i> Update Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('templates/footer') ?>
