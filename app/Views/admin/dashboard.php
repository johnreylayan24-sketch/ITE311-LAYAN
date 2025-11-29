<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4 pt-4">
    <!-- Page Heading -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <div class="mb-3 mb-md-0">
            <h1 class="h3 mb-1 fw-bold text-gray-900">Dashboard</h1>
            <p class="text-muted mb-0">Welcome back, <?= session()->get('user_name') ?? 'Admin' ?></p>
        </div>
        <div class="d-flex align-items-center">
            <span class="badge bg-dark text-white px-3 py-2 rounded-pill">
                <i class="far fa-calendar-alt me-2"></i><?= date('l, F j, Y') ?>
            </span>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <!-- Total Users Card -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100 bg-dark text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-uppercase small fw-bold text-gray-400">Total Users</span>
                            <h2 class="mt-2 mb-0 fw-bold"><?= number_format($totalUsers ?? 0) ?></h2>
                            <div class="mt-3">
                                <a href="<?= base_url('admin/users') ?>" class="btn btn-sm btn-outline-light">
                                    View All <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                        <div class="bg-dark bg-opacity-25 p-3 rounded-3">
                            <i class="fas fa-users fa-2x text-white-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Teachers Card -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100 bg-dark text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-uppercase small fw-bold text-gray-400">Teachers</span>
                            <h2 class="mt-2 mb-0 fw-bold"><?= number_format($totalTeachers ?? 0) ?></h2>
                            <div class="mt-3">
                                <a href="<?= base_url('admin/users?role=teacher') ?>" class="btn btn-sm btn-outline-light">
                                    View All <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                        <div class="bg-dark bg-opacity-25 p-3 rounded-3">
                            <i class="fas fa-chalkboard-teacher fa-2x text-white-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Students Card -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100 bg-dark text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-uppercase small fw-bold text-gray-400">Students</span>
                            <h2 class="mt-2 mb-0 fw-bold"><?= number_format($totalStudents ?? 0) ?></h2>
                            <div class="mt-3">
                                <a href="<?= base_url('admin/users?role=student') ?>" class="btn btn-sm btn-outline-light">
                                    View All <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                        <div class="bg-dark bg-opacity-25 p-3 rounded-3">
                            <i class="fas fa-user-graduate fa-2x text-white-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Courses Card -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100 bg-dark text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-uppercase small fw-bold text-gray-400">Courses</span>
                            <h2 class="mt-2 mb-0 fw-bold"><?= number_format($totalCourses ?? 0) ?></h2>
                            <div class="mt-3">
                                <a href="<?= base_url('admin/courses') ?>" class="btn btn-sm btn-outline-light">
                                    View All <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                        <div class="bg-dark bg-opacity-25 p-3 rounded-3">
                            <i class="fas fa-book fa-2x text-white-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row g-3">
        <!-- Recent Users -->
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-dark text-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold">Recent Users</h6>
                    <a href="<?= base_url('admin/users') ?>" class="btn btn-sm btn-outline-primary">
                        View All
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3">Name</th>
                                    <th class="px-4 py-3">Email</th>
                                    <th class="px-4 py-3 text-center">Role</th>
                                    <th class="px-4 py-3 text-end">Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($recentUsers)): ?>
                                    <?php foreach ($recentUsers as $user): ?>
                                        <tr>
                                            <td class="px-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-3">
                                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                            <?= strtoupper(substr($user['name'], 0, 1)) ?>
                                                        </span>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0"><?= esc($user['name']) ?></h6>
                                                        <small class="text-muted">ID: <?= $user['id'] ?? 'N/A' ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3"><?= esc($user['email']) ?></td>
                                            <td class="px-4 py-3 text-center">
                                                <span class="badge bg-soft-<?= $user['role'] === 'admin' ? 'danger' : ($user['role'] === 'teacher' ? 'success' : 'info') ?> text-<?= $user['role'] === 'admin' ? 'danger' : ($user['role'] === 'teacher' ? 'success' : 'info') ?>">
                                                    <?= ucfirst($user['role']) ?>
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-end">
                                                <small class="text-muted" data-bs-toggle="tooltip" title="<?= date('F j, Y, g:i a', strtotime($user['created_at'])) ?>">
                                                    <?= date('M d, Y', strtotime($user['created_at'])) ?>
                                                </small>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-users fa-2x mb-2"></i>
                                                <p class="mb-0">No users found</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-dark text-white py-3">
                    <h6 class="m-0 fw-bold">Quick Actions</h6>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="<?= base_url('admin/users/create') ?>" class="list-group-item list-group-item-action border-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-shape icon-md bg-soft-primary text-primary rounded-3 me-3">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Add New User</h6>
                                    <p class="mb-0 small text-muted">Create a new user account</p>
                                </div>
                                <div class="ms-auto">
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                            </div>
                        </a>
                        
                        <a href="<?= base_url('admin/courses/create') ?>" class="list-group-item list-group-item-action border-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-shape icon-md bg-soft-success text-success rounded-3 me-3">
                                    <i class="fas fa-plus-circle"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Create Course</h6>
                                    <p class="mb-0 small text-muted">Add a new course to the system</p>
                                </div>
                                <div class="ms-auto">
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                            </div>
                        </a>
                        
                        <a href="<?= base_url('admin/settings') ?>" class="list-group-item list-group-item-action border-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-shape icon-md bg-soft-info text-info rounded-3 me-3">
                                    <i class="fas fa-cog"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">System Settings</h6>
                                    <p class="mb-0 small text-muted">Configure system preferences</p>
                                </div>
                                <div class="ms-auto">
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                            </div>
                        </a>
                        
                        <a href="<?= base_url('admin/reports') ?>" class="list-group-item list-group-item-action border-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-shape icon-md bg-soft-warning text-warning rounded-3 me-3">
                                    <i class="fas fa-chart-pie"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">View Reports</h6>
                                    <p class="mb-0 small text-muted">View system analytics and reports</p>
                                </div>
                                <div class="ms-auto">
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    body {
        background-color: #f5f7fa;
    }
    
    .card {
        border: none;
        transition: all 0.3s ease;
        border-radius: 0.5rem;
        overflow: hidden;
    }
    
    .card.bg-dark {
        background: linear-gradient(135deg, #2c3e50 0%, #1a1a2e 100%) !important;
        border: none;
    }
    
    .card.bg-dark:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.15) !important;
    }
    
    .card-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        background-color: transparent;
    }
    
    .table {
        margin-bottom: 0;
    }
    
    .table thead th {
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 0.5px;
        color: #6c757d;
        background-color: #f8f9fc;
    }
    
    .table tbody tr {
        transition: all 0.2s ease;
    }
    
    .table tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
    
    .avatar-sm {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #e9ecef;
        color: #4e73df;
        font-weight: 600;
        font-size: 0.875rem;
    }
    
    .btn-outline-light:hover {
        color: #2c3e50 !important;
        background-color: #f8f9fa;
        border-color: #f8f9fa;
    }
    
    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
    }
    
    .text-gray-400 {
        color: #adb5bd !important;
    }
    
    .text-white-50 {
        opacity: 0.8;
    }
    
    .quick-action-item {
        border-left: 3px solid transparent;
        transition: all 0.2s ease;
    }
    
    .quick-action-item:hover {
        background-color: #f8f9fa;
        border-left-color: #4e73df;
    }
</style>

<?= $this->endSection() ?>
