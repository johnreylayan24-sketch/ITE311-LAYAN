<?php
/**
 * Complete LMS Setup Script
 * This script will set up the entire Learning Management System with:
 * 1. Database tables creation
 * 2. Test users with different roles
 * 3. Sample courses
 * 4. Database sessions configuration
 */

require_once 'vendor/autoload.php';

use Config\Database;

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>LMS Complete Setup</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <style>
        .setup-step { margin: 20px 0; padding: 15px; border-radius: 5px; }
        .success { background-color: #d1edff; border-left: 4px solid #2196F3; }
        .error { background-color: #ffebee; border-left: 4px solid #f44336; }
        .info { background-color: #f3e5f5; border-left: 4px solid #9c27b0; }
        .code { background-color: #f5f5f5; padding: 10px; border-radius: 3px; font-family: monospace; }
    </style>
</head>
<body class='bg-light'>
<div class='container mt-5'>";

echo "<h1 class='text-center mb-4'>🚀 Complete LMS Setup</h1>\n";

try {
    $db = Database::connect();
    echo "<div class='setup-step success'>✅ Database Connection: SUCCESS</div>\n";

    // Step 1: Create ci_sessions table
    echo "<div class='setup-step info'>📋 Step 1: Creating ci_sessions table...</div>\n";
    $tables = $db->listTables();
    if (!in_array('ci_sessions', $tables)) {
        $db->query("
            CREATE TABLE `ci_sessions` (
              `id` varchar(128) NOT NULL,
              `ip_address` varchar(45) NOT NULL,
              `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
              `data` mediumblob NOT NULL,
              PRIMARY KEY (`id`),
              KEY `ci_sessions_timestamp` (`timestamp`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
        ");
        echo "<div class='setup-step success'>✅ ci_sessions table created!</div>\n";
    } else {
        echo "<div class='setup-step success'>✅ ci_sessions table already exists!</div>\n";
    }

    // Step 2: Create users table
    echo "<div class='setup-step info'>👥 Step 2: Creating users table...</div>\n";
    if (!in_array('users', $tables)) {
        $db->query("
            CREATE TABLE `users` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(100) NOT NULL,
              `email` varchar(255) NOT NULL UNIQUE,
              `password` varchar(255) NOT NULL,
              `role` enum('admin','teacher','user') NOT NULL DEFAULT 'user',
              `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
              `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`),
              UNIQUE KEY `email` (`email`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
        ");
        echo "<div class='setup-step success'>✅ Users table created!</div>\n";
    } else {
        echo "<div class='setup-step success'>✅ Users table already exists!</div>\n";
    }

    // Step 3: Create courses table
    echo "<div class='setup-step info'>📚 Step 3: Creating courses table...</div>\n";
    if (!in_array('courses', $tables)) {
        $db->query("
            CREATE TABLE `courses` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `title` varchar(255) NOT NULL,
              `description` text,
              `created_by` int(11) DEFAULT NULL,
              `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
              `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`),
              KEY `created_by` (`created_by`),
              FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE SET NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
        ");
        echo "<div class='setup-step success'>✅ Courses table created!</div>\n";
    } else {
        echo "<div class='setup-step success'>✅ Courses table already exists!</div>\n";
    }

    // Step 4: Create enrollments table
    echo "<div class='setup-step info'>📝 Step 4: Creating enrollments table...</div>\n";
    if (!in_array('enrollments', $tables)) {
        $db->query("
            CREATE TABLE `enrollments` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `user_id` int(11) NOT NULL,
              `course_id` int(11) NOT NULL,
              `enrolled_at` datetime DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`),
              UNIQUE KEY `user_course` (`user_id`, `course_id`),
              KEY `user_id` (`user_id`),
              KEY `course_id` (`course_id`),
              FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
              FOREIGN KEY (`course_id`) REFERENCES `courses`(`id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
        ");
        echo "<div class='setup-step success'>✅ Enrollments table created!</div>\n";
    } else {
        echo "<div class='setup-step success'>✅ Enrollments table already exists!</div>\n";
    }

    // Step 5: Create test users
    echo "<div class='setup-step info'>👥 Step 5: Creating test users...</div>\n";
    $userCount = $db->table('users')->countAll();

    if ($userCount == 0) {
        $testUsers = [
            [
                'name' => 'System Administrator',
                'email' => 'admin@lms.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'John Teacher',
                'email' => 'teacher@lms.com',
                'password' => password_hash('teacher123', PASSWORD_DEFAULT),
                'role' => 'teacher',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Jane Student',
                'email' => 'student@lms.com',
                'password' => password_hash('student123', PASSWORD_DEFAULT),
                'role' => 'user',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $db->table('users')->insertBatch($testUsers);
        echo "<div class='setup-step success'>✅ Test users created!</div>\n";
    } else {
        echo "<div class='setup-step success'>✅ Users already exist! ($userCount users found)</div>\n";
    }

    // Step 6: Create sample courses
    echo "<div class='setup-step info'>📚 Step 6: Creating sample courses...</div>\n";
    $courseCount = $db->table('courses')->countAll();

    if ($courseCount == 0) {
        $sampleCourses = [
            [
                'title' => 'Introduction to Web Development',
                'description' => 'Learn the basics of HTML, CSS, and JavaScript to build modern websites.',
                'created_by' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Database Design Fundamentals',
                'description' => 'Master database design principles and SQL for data management.',
                'created_by' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'PHP Programming Advanced',
                'description' => 'Advanced PHP concepts including OOP, frameworks, and best practices.',
                'created_by' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Mobile App Development',
                'description' => 'Create mobile applications for iOS and Android platforms.',
                'created_by' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $db->table('courses')->insertBatch($sampleCourses);
        echo "<div class='setup-step success'>✅ Sample courses created!</div>\n";
    } else {
        echo "<div class='setup-step success'>✅ Courses already exist! ($courseCount courses found)</div>\n";
    }

    // Step 7: Display login credentials
    echo "<div class='setup-step info'>🔑 Step 7: Test Login Credentials</div>\n";
    echo "<div class='row'>";
    echo "<div class='col-md-4'>";
    echo "<div class='card border-danger'>";
    echo "<div class='card-header bg-danger text-white'><h5 class='mb-0'>👑 Admin Access</h5></div>";
    echo "<div class='card-body'>";
    echo "<p><strong>Email:</strong> admin@lms.com</p>";
    echo "<p><strong>Password:</strong> admin123</p>";
    echo "<p><small class='text-muted'>Full system access, user management, course management</small></p>";
    echo "</div></div></div>";

    echo "<div class='col-md-4'>";
    echo "<div class='card border-warning'>";
    echo "<div class='card-header bg-warning text-white'><h5 class='mb-0'>👨‍🏫 Teacher Access</h5></div>";
    echo "<div class='card-body'>";
    echo "<p><strong>Email:</strong> teacher@lms.com</p>";
    echo "<p><strong>Password:</strong> teacher123</p>";
    echo "<p><small class='text-muted'>Course creation, student management, content management</small></p>";
    echo "</div></div></div>";

    echo "<div class='col-md-4'>";
    echo "<div class='card border-info'>";
    echo "<div class='card-header bg-info text-white'><h5 class='mb-0'>👨‍🎓 Student Access</h5></div>";
    echo "<div class='card-body'>";
    echo "<p><strong>Email:</strong> student@lms.com</p>";
    echo "<p><strong>Password:</strong> student123</p>";
    echo "<p><small class='text-muted'>Course enrollment, learning materials, progress tracking</small></p>";
    echo "</div></div></div>";
    echo "</div>";

    echo "<div class='setup-step success'>🎉 Setup Complete!</div>\n";

    echo "<div class='alert alert-success mt-4'>";
    echo "<h4>🚀 Next Steps:</h4>";
    echo "<ol class='mb-0'>";
    echo "<li><strong>Go to:</strong> <a href='http://localhost/ITE311-LAYAN/public/' target='_blank' class='btn btn-primary btn-sm'>Your LMS Site</a></li>";
    echo "<li><strong>Login with:</strong> Any of the credentials above</li>";
    echo "<li><strong>Test Features:</strong> Try different roles and navigation</li>";
    echo "<li><strong>Delete this file:</strong> <code>setup_complete.php</code> for security</li>";
    echo "</ol>";
    echo "</div>";

    echo "<div class='alert alert-info'>";
    echo "<h5>🔧 System Features Implemented:</h5>";
    echo "<ul>";
    echo "<li>✅ Role-based authentication (Admin, Teacher, Student)</li>";
    echo "<li>✅ Database session management</li>";
    echo "<li>✅ Unified dashboard with conditional content</li>";
    echo "<li>✅ Dynamic navigation bar</li>";
    echo "<li>✅ Course enrollment system</li>";
    echo "<li>✅ User management (Admin only)</li>";
    echo "<li>✅ Responsive design with Bootstrap 5.3.3</li>";
    echo "<li>✅ CSRF protection and input validation</li>";
    echo "</ul>";
    echo "</div>";

} catch (Exception $e) {
    echo "<div class='setup-step error'>❌ Error: " . $e->getMessage() . "</div>\n";
    echo "<div class='alert alert-danger'>";
    echo "<h5>🔧 Troubleshooting:</h5>";
    echo "<ul>";
    echo "<li>Ensure XAMPP is running</li>";
    echo "<li>Check if MySQL service is started</li>";
    echo "<li>Verify database 'lms_layan' exists</li>";
    echo "<li>Check database credentials in app/Config/Database.php</li>";
    echo "</ul>";
    echo "</div>";
}

echo "</div></body></html>";
?>
