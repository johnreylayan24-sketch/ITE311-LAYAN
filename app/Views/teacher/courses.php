<?php include_once 'app/Views/templates/header.php'; ?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">📚 My Courses</h4>
                    <small class="text-white-50">Teacher: <?= esc($teacher['username']) ?></small>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($courses)): ?>
                        <div class="row">
                            <?php foreach ($courses as $course): ?>
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card h-100 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary">
                                                <i class="fas fa-book"></i> <?= esc($course->course_name) ?>
                                            </h5>
                                            <p class="card-text">
                                                <strong>Course Code:</strong> <?= esc($course->course_code) ?><br>
                                                <strong>Description:</strong> <?= esc($course->description) ?><br>
                                                <strong>Schedule:</strong> <?= esc($course->schedule) ?><br>
                                                <strong>Students:</strong> 
                                                <?php 
                                                    // Get student count for this course
                                                    $db = \Config\Database::connect();
                                                    $studentCount = $db->query("SELECT COUNT(*) as count FROM enrollments WHERE course_id = ?", [$course->id])->getRow()->count;
                                                    echo $studentCount;
                                                ?>
                                            </p>
                                        </div>
                                        <div class="card-footer bg-transparent">
                                            <div class="btn-group w-100" role="group">
                                                <a href="<?= base_url('teacher/assignments') ?>" class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-tasks"></i> Assignments
                                                </a>
                                                <a href="<?= base_url('teacher/grades') ?>" class="btn btn-outline-success btn-sm">
                                                    <i class="fas fa-chart-bar"></i> Grades
                                                </a>
                                                <a href="<?= base_url('teacher/students') ?>" class="btn btn-outline-info btn-sm">
                                                    <i class="fas fa-users"></i> Students
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No Courses Found</h4>
                            <p class="text-muted">You haven't been assigned any courses yet.</p>
                            <button class="btn btn-primary" onclick="alert('Contact administrator to assign courses to you.')">
                                <i class="fas fa-plus"></i> Request Course Assignment
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Stats -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4><?= count($courses) ?></h4>
                            <p>Total Courses</p>
                        </div>
                        <div>
                            <i class="fas fa-book fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>
                                <?php 
                                    $totalStudents = 0;
                                    if (!empty($courses)) {
                                        foreach ($courses as $course) {
                                            $db = \Config\Database::connect();
                                            $studentCount = $db->query("SELECT COUNT(*) as count FROM enrollments WHERE course_id = ?", [$course->id])->getRow()->count;
                                            $totalStudents += $studentCount;
                                        }
                                    }
                                    echo $totalStudents;
                                ?>
                            </h4>
                            <p>Total Students</p>
                        </div>
                        <div>
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>
                                <?php 
                                    $totalAssignments = 0;
                                    if (!empty($courses)) {
                                        foreach ($courses as $course) {
                                            $db = \Config\Database::connect();
                                            $assignmentCount = $db->query("SELECT COUNT(*) as count FROM assignments WHERE course_id = ?", [$course->id])->getRow()->count;
                                            $totalAssignments += $assignmentCount;
                                        }
                                    }
                                    echo $totalAssignments;
                                ?>
                            </h4>
                            <p>Assignments</p>
                        </div>
                        <div>
                            <i class="fas fa-tasks fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>
                                <?php 
                                    $pendingSubmissions = 0;
                                    if (!empty($courses)) {
                                        foreach ($courses as $course) {
                                            $db = \Config\Database::connect();
                                            $pendingCount = $db->query("
                                                SELECT COUNT(*) as count 
                                                FROM assignment_submissions asub
                                                JOIN assignments a ON asub.assignment_id = a.id
                                                WHERE a.course_id = ? AND asub.status = 'pending'
                                            ", [$course->id])->getRow()->count;
                                            $pendingSubmissions += $pendingCount;
                                        }
                                    }
                                    echo $pendingSubmissions;
                                ?>
                            </h4>
                            <p>Pending Reviews</p>
                        </div>
                        <div>
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add some sample courses if none exist -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Check if we need to add sample courses
    const courseCards = document.querySelectorAll('.row .col-md-6');
    if (courseCards.length === 0) {
        console.log('No courses found. You may need to add sample courses to the database.');
    }
});
</script>

<?php include_once 'app/Views/templates/footer.php'; ?>
