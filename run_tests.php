<?php
session_start();

// Comprehensive Testing Script for Step 7
echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "<head>";
echo "    <meta charset='UTF-8'>";
echo "    <meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "    <title>Step 7 - Application Testing</title>";
echo "    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>";
echo "    <style>";
echo "        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; }";
echo "        .test-card { background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); border-radius: 15px; }";
echo "        .role-admin { background: linear-gradient(135deg, #ff6b6b, #ee5a24); }";
echo "        .role-teacher { background: linear-gradient(135deg, #4ecdc4, #44a08d); }";
echo "        .role-student { background: linear-gradient(135deg, #667eea, #764ba2); }";
echo "        .role-guest { background: linear-gradient(135deg, #95a5a6, #7f8c8d); }";
echo "    </style>";
echo "</head>";
echo "<body>";
echo "<div class='container py-5'>";

// Test Results Storage
$testResults = [];

// Function to add test result
function addTestResult($category, $test, $status, $details = '') {
    global $testResults;
    $testResults[] = [
        'category' => $category,
        'test' => $test,
        'status' => $status,
        'details' => $details
    ];
}

// Function to display test results
function displayTestResults() {
    global $testResults;
    
    echo "<div class='row mt-4'>";
    echo "<div class='col-12'>";
    echo "<div class='test-card p-4'>";
    echo "<h3 class='mb-4'>🧪 Test Results Summary</h3>";
    
    $categories = array_unique(array_column($testResults, 'category'));
    
    foreach ($categories as $category) {
        echo "<h5 class='mt-3 mb-3'>$category</h5>";
        $categoryTests = array_filter($testResults, function($test) use ($category) {
            return $test['category'] === $category;
        });
        
        foreach ($categoryTests as $test) {
            $statusIcon = $test['status'] === 'PASS' ? '✅' : '❌';
            $statusClass = $test['status'] === 'PASS' ? 'text-success' : 'text-danger';
            echo "<div class='mb-2'>";
            echo "<span class='$statusClass'>$statusIcon {$test['test']}</span>";
            if ($test['details']) {
                echo "<br><small class='text-muted'>{$test['details']}</small>";
            }
            echo "</div>";
        }
    }
    
    // Overall result
    $passCount = count(array_filter($testResults, function($test) { return $test['status'] === 'PASS'; }));
    $totalCount = count($testResults);
    $overallResult = $passCount === $totalCount ? 'PASS' : 'FAIL';
    $overallClass = $overallResult === 'PASS' ? 'success' : 'danger';
    
    echo "<hr>";
    echo "<div class='alert alert-{$overallClass}'>";
    echo "<h4>Overall Result: $overallResult ($passCount/$totalCount tests passed)</h4>";
    echo "</div>";
    
    echo "</div>";
    echo "</div>";
    echo "</div>";
}

// Current user info
$currentRole = isset($_SESSION['user']) ? $_SESSION['user']['role'] : 'guest';
$currentUsername = isset($_SESSION['user']) ? $_SESSION['user']['username'] : 'Guest';

echo "<div class='row'>";
echo "<div class='col-12'>";
echo "<div class='test-card p-4'>";
echo "<h1 class='text-center mb-4'>🧪 Step 7: Application Testing</h1>";

// Current session info
echo "<div class='alert alert-info'>";
echo "<h4>Current Session:</h4>";
echo "<p><strong>Username:</strong> $currentUsername</p>";
echo "<p><strong>Role:</strong> <span class='badge role-$currentRole text-white'>" . strtoupper($currentRole) . "</span></p>";
echo "</div>";

// Test Navigation
echo "<div class='row mb-4'>";
echo "<div class='col-md-6'>";
echo "<h4>🔐 Login Testing</h4>";
echo "<div class='list-group'>";
echo "<a href='/ITE311-LAYAN/login' class='list-group-item list-group-item-action'>Go to Login Page</a>";
echo "<a href='/ITE311-LAYAN/register' class='list-group-item list-group-item-action'>Go to Register Page</a>";
echo "</div>";
echo "</div>";

echo "<div class='col-md-6'>";
echo "<h4>🏠 Dashboard Testing</h4>";
echo "<div class='list-group'>";
echo "<a href='/ITE311-LAYAN/dashboard' class='list-group-item list-group-item-action'>Go to Dashboard</a>";
echo "<a href='/ITE311-LAYAN/logout' class='list-group-item list-group-item-action'>Logout</a>";
echo "</div>";
echo "</div>";
echo "</div>";

// Test Credentials
echo "<div class='alert alert-warning'>";
echo "<h4>🔑 Test Credentials:</h4>";
echo "<table class='table table-sm'>";
echo "<thead><tr><th>Role</th><th>Username</th><th>Password</th></tr></thead>";
echo "<tbody>";
echo "<tr><td><span class='badge role-admin text-white'>ADMIN</span></td><td>admin</td><td>admin123</td></tr>";
echo "<tr><td><span class='badge role-teacher text-white'>TEACHER</span></td><td>teacher</td><td>teacher123</td></tr>";
echo "<tr><td><span class='badge role-student text-white'>STUDENT</span></td><td>student</td><td>student123</td></tr>";
echo "</tbody>";
echo "</table>";
echo "</div>";

// Test Checklists
echo "<div class='row'>";
echo "<div class='col-md-6'>";
echo "<h4>✅ Manual Testing Checklist</h4>";
echo "<div class='form-check'>";
echo "<input class='form-check-input' type='checkbox' id='test1'>";
echo "<label class='form-check-label' for='test1'>All users redirected to same dashboard</label>";
echo "</div>";
echo "<div class='form-check'>";
echo "<input class='form-check-input' type='checkbox' id='test2'>";
echo "<label class='form-check-label' for='test2'>Dashboard shows role-specific content</label>";
echo "</div>";
echo "<div class='form-check'>";
echo "<input class='form-check-input' type='checkbox' id='test3'>";
echo "<label class='form-check-label' for='test3'>Navigation shows correct menu items</label>";
echo "</div>";
echo "<div class='form-check'>";
echo "<input class='form-check-input' type='checkbox' id='test4'>";
echo "<label class='form-check-label' for='test4'>Access control working properly</label>";
echo "</div>";
echo "<div class='form-check'>";
echo "<input class='form-check-input' type='checkbox' id='test5'>";
echo "<label class='form-check-label' for='test5'>Logout functionality working</label>";
echo "</div>";
echo "</div>";

echo "<div class='col-md-6'>";
echo "<h4>🔗 URL Access Testing</h4>";
echo "<div class='list-group'>";
echo "<a href='/ITE311-LAYAN/admin/users' class='list-group-item list-group-item-action'>Test: /admin/users (Admin Only)</a>";
echo "<a href='/ITE311-LAYAN/teacher/courses' class='list-group-item list-group-item-action'>Test: /teacher/courses (Teacher Only)</a>";
echo "<a href='/ITE311-LAYAN/student/courses' class='list-group-item list-group-item-action'>Test: /student/courses (Student Only)</a>";
echo "<a href='/ITE311-LAYAN/profile' class='list-group-item list-group-item-action'>Test: /profile (All Authenticated Users)</a>";
echo "<a href='/ITE311-LAYAN/settings' class='list-group-item list-group-item-action'>Test: /settings (All Authenticated Users)</a>";
echo "</div>";
echo "</div>";
echo "</div>";

// Automated Tests
echo "<div class='mt-4'>";
echo "<h4>🤖 Automated Tests</h4>";

// Test 1: Session Check
if (isset($_SESSION['user'])) {
    addTestResult('Session Management', 'User session exists', 'PASS', 'User is logged in');
} else {
    addTestResult('Session Management', 'User session exists', 'FAIL', 'No user session found');
}

// Test 2: Role Detection
$expectedRoles = ['admin', 'teacher', 'student', 'guest'];
if (in_array($currentRole, $expectedRoles)) {
    addTestResult('Role Management', 'Valid role detected', 'PASS', "Role: $currentRole");
} else {
    addTestResult('Role Management', 'Valid role detected', 'FAIL', "Invalid role: $currentRole");
}

// Test 3: Navigation File Existence
if (file_exists('app/Views/templates/header.php')) {
    addTestResult('File System', 'Header template exists', 'PASS', 'app/Views/templates/header.php found');
} else {
    addTestResult('File System', 'Header template exists', 'FAIL', 'Header template not found');
}

// Test 4: Routes Configuration
if (file_exists('app/Config/Routes.php')) {
    addTestResult('Configuration', 'Routes file exists', 'PASS', 'app/Config/Routes.php found');
} else {
    addTestResult('Configuration', 'Routes file exists', 'FAIL', 'Routes file not found');
}

// Test 5: Dashboard Route
$routesContent = file_get_contents('app/Config/Routes.php');
if (strpos($routesContent, "routes->get('/dashboard', 'Auth::dashboard')") !== false) {
    addTestResult('Configuration', 'Dashboard route configured', 'PASS', 'Dashboard route found in Routes.php');
} else {
    addTestResult('Configuration', 'Dashboard route configured', 'FAIL', 'Dashboard route not found');
}

echo "</div>";

echo "</div>";
echo "</div>";
echo "</div>";

// Display test results
displayTestResults();

echo "<div class='row mt-4'>";
echo "<div class='col-12'>";
echo "<div class='test-card p-4 text-center'>";
echo "<h4>📋 Testing Instructions</h4>";
echo "<ol class='text-start'>";
echo "<li><strong>Create Test Users:</strong> Run <code>create_test_users.php</code> first</li>";
echo "<li><strong>Test Each Role:</strong> Log in with admin, teacher, and student accounts</li>";
echo "<li><strong>Verify Dashboard:</strong> Check that all users go to same dashboard URL</li>";
echo "<li><strong>Check Content:</strong> Verify dashboard content changes by role</li>";
echo "<li><strong>Test Navigation:</strong> Confirm menu items are role-specific</li>";
echo "<li><strong>Test Access Control:</strong> Try accessing restricted URLs</li>";
echo "<li><strong>Test Logout:</strong> Verify logout works for all roles</li>";
echo "</ol>";
echo "<div class='mt-3'>";
echo "<a href='create_test_users.php' class='btn btn-primary me-2'>Create Test Users</a>";
echo "<a href='test_navigation.php' class='btn btn-secondary me-2'>Test Navigation</a>";
echo "<a href='/ITE311-LAYAN/logout' class='btn btn-warning'>Logout</a>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";

echo "</div>";
echo "</body>";
echo "</html>";
?>
