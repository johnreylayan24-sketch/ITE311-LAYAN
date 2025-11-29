<?php
// Test script to verify role-based dashboard and navigation access
// This script helps verify that the role-based system is working correctly

echo "<h1>🔐 Role-Based Access Testing</h1>";
echo "<p>This script will help you test the role-based dashboard and navigation system.</p>";

// Test credentials
$testUsers = [
    [
        'role' => 'admin',
        'email' => 'admin@gmail.com',
        'password' => 'admin123',
        'name' => 'Admin User'
    ],
    [
        'role' => 'teacher',
        'email' => 'teacher@gmail.com',
        'password' => 'teacher123',
        'name' => 'Teacher User'
    ],
    [
        'role' => 'student',
        'email' => 'student@gmail.com',
        'password' => 'student123',
        'name' => 'Student User'
    ]
];

echo "<h2>📋 Test Instructions</h2>";
echo "<ol>";
echo "<li><strong>Test Login Process:</strong></li>";
echo "<ul>";
foreach ($testUsers as $user) {
    echo "<li>Log in as <strong>{$user['role']}</strong>:<br>";
    echo "   - Email: {$user['email']}<br>";
    echo "   - Password: {$user['password']}<br>";
    echo "   - Expected: Should redirect to dashboard with role-specific content</li>";
}
echo "</ul>";

echo "<li><strong>Test Dashboard Content:</strong></li>";
echo "<ul>";
echo "<li><strong>Admin Dashboard:</strong> Should show system statistics, user management, analytics</li>";
echo "<li><strong>Teacher Dashboard:</strong> Should show courses, students, assignments, grades</li>";
echo "<li><strong>Student Dashboard:</strong> Should show enrolled courses, assignments, grades</li>";
echo "</ul>";

echo "<li><strong>Test Navigation Menu:</strong></li>";
echo "<ul>";
echo "<li><strong>Admin Navigation:</strong> Should show Admin dropdown with users, courses, settings, analytics, reports</li>";
echo "<li><strong>Teacher Navigation:</strong> Should show Teacher dropdown with courses, assignments, grades, students</li>";
echo "<li><strong>Student Navigation:</strong> Should show Learning dropdown with courses, assignments, grades, schedule</li>";
echo "</ul>";

echo "<li><strong>Test Security Features:</strong></li>";
echo "<ul>";
echo "<li>Try accessing admin/teacher URLs as a student (should be denied)</li>";
echo "<li>Try accessing student URLs as a teacher (should be denied)</li>";
echo "<li>Test rate limiting by entering wrong passwords 5 times</li>";
echo "<li>Test session timeout and logout functionality</li>";
echo "</ul>";

echo "</ol>";

echo "<h2>🔗 Quick Links</h2>";
echo "<ul>";
echo "<li><a href='/ITE311-LAYAN/login' target='_blank'>🔐 Login Page</a></li>";
echo "<li><a href='/ITE311-LAYAN/register' target='_blank'>📝 Register Page</a></li>";
echo "<li><a href='/ITE311-LAYAN/dashboard' target='_blank'>📊 Dashboard (requires login)</a></li>";
echo "</ul>";

echo "<h2>✅ Expected Results</h2>";
echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
echo "<tr><th>Role</th><th>Dashboard Features</th><th>Navigation Items</th><th>Access Level</th></tr>";

echo "<tr><td><strong>🔴 Admin</strong></td><td>";
echo "- Total users count<br>";
echo "- Admin/Teacher/Student counts<br>";
echo "- System statistics<br>";
echo "- Recent user registrations<br>";
echo "- System analytics</td>";
echo "<td>";
echo "- Admin ▼<br>";
echo "  - Users<br>";
echo "  - Courses<br>";
echo "  - Settings<br>";
echo "  - Analytics<br>";
echo "  - Reports</td>";
echo "<td>Full system access</td></tr>";

echo "<tr><td><strong>🔵 Teacher</strong></td><td>";
echo "- Courses taught<br>";
echo "- Students enrolled<br>";
echo "- Assignments count<br>";
echo "- Pending submissions<br>";
echo "- Recent grades</td>";
echo "<td>";
echo "- Teacher ▼<br>";
echo "  - Courses<br>";
echo "  - Assignments<br>";
echo "  - Grades<br>";
echo "  - Students</td>";
echo "<td>Teacher-level access</td></tr>";

echo "<tr><td><strong>🟢 Student</strong></td><td>";
echo "- Enrolled courses<br>";
echo "- Completed assignments<br>";
echo "- Pending assignments<br>";
echo "- Average grade<br>";
echo "- Course progress</td>";
echo "<td>";
echo "- Learning ▼<br>";
echo "  - Courses<br>";
echo "  - Assignments<br>";
echo "  - Grades<br>";
echo "  - Schedule</td>";
echo "<td>Student-level access</td></tr>";

echo "</table>";

echo "<h2>🛡️ Security Tests</h2>";
echo "<p><strong>Test these security features:</strong></p>";
echo "<ul>";
echo "<li><strong>Password Requirements:</strong> Try registering with weak passwords (should be rejected)</li>";
echo "<li><strong>Rate Limiting:</strong> Enter wrong password 5 times (should lock for 5 minutes)</li>";
echo "<li><strong>Session Security:</strong> Log in, then try session hijacking prevention</li>";
echo "<li><strong>Input Validation:</strong> Try SQL injection attempts in login forms</li>";
echo "<li><strong>Access Control:</strong> Try accessing restricted URLs directly</li>";
echo "</ul>";

echo "<hr>";
echo "<p><strong>🎯 Testing Complete?</strong> Once you've verified all the above functionality works correctly, your role-based system is fully implemented and secure!</p>";
?>
