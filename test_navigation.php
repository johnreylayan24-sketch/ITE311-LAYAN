<?php
// Start session for testing
session_start();

// Handle role switching
if (isset($_GET['role']) && in_array($_GET['role'], ['admin', 'teacher', 'student', 'guest'])) {
    $test_role = $_GET['role'];
    
    // Set up test user session
    if ($test_role === 'guest') {
        unset($_SESSION['user']);
    } else {
        $_SESSION['user'] = [
            'id' => 1,
            'username' => 'test' . $test_role,
            'email' => $test_role . '@example.com',
            'role' => $test_role
        ];
    }
    
    // Redirect to remove query parameter
    header('Location: test_navigation.php');
    exit;
}

// Get current role from session
$test_role = isset($_SESSION['user']) ? $_SESSION['user']['role'] : 'guest';

// Include the header template to test navigation
$page_title = 'Navigation Test';
include_once 'app/Views/templates/header.php';
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="glass-card p-4">
                <h2 class="text-white mb-4">Navigation Bar Test</h2>
                
                <div class="alert alert-info">
                    <h4>Current Test Role: <span class="badge badge-<?= $test_role ?>"><?= strtoupper($test_role) ?></span></h4>
                    <p class="mb-0">This page tests the dynamic navigation bar for the <strong><?= $test_role ?></strong> role.</p>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="text-white">Navigation Features:</h4>
                        <ul class="text-white">
                            <li>✅ Role-based navigation items</li>
                            <li>✅ User avatar and role badge</li>
                            <li>✅ Dropdown menus with icons</li>
                            <li>✅ Responsive mobile design</li>
                            <li>✅ Active link highlighting</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h4 class="text-white">Test Instructions:</h4>
                        <ol class="text-white">
                            <li>Check the navigation bar above</li>
                            <li>Verify role-specific menu items</li>
                            <li>Test dropdown functionality</li>
                            <li>Check mobile responsiveness</li>
                            <li>Test user profile dropdown</li>
                        </ol>
                    </div>
                </div>
                
                <div class="mt-4">
                    <h4 class="text-white">Quick Role Switch:</h4>
                    <div class="btn-group" role="group">
                        <a href="?role=admin" class="btn btn-outline-light">Admin</a>
                        <a href="?role=teacher" class="btn btn-outline-light">Teacher</a>
                        <a href="?role=student" class="btn btn-outline-light">Student</a>
                        <a href="?role=guest" class="btn btn-outline-light">Guest</a>
                    </div>
                </div>
                
                <?php if (isset($_GET['role'])): ?>
                    <div class="mt-3">
                        <div class="alert alert-success">
                            <strong>Role changed!</strong> Please refresh the page to see the navigation for the new role.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
// Include footer template
include_once 'app/Views/templates/footer.php';
?>
