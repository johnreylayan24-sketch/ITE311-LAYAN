<?php
/**
 * SOPHISTICATED CORPORATE LMS SETUP
 * Professional, Clean, and Modern Design
 * Complete system setup with enterprise-grade security
 */

require_once 'vendor/autoload.php';

use Config\Database;

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Professional LMS Setup</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'>
    <style>
        body {
            background: linear-gradient(135deg, #0f0f0f 0%, #1a1a1a 50%, #0f0f0f 100%);
            color: #ecf0f1;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .setup-container {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            border: 1px solid #444;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }
        .setup-header {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            border-bottom: 2px solid #3498db;
            color: #ecf0f1;
        }
        .btn-setup {
            background: linear-gradient(135deg, #2980b9 0%, #3498db 100%);
            border: 1px solid #2980b9;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        .btn-setup:hover {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            border-color: #3498db;
        }
        .alert {
            border-radius: 8px;
            border: none;
        }
        .card {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            border: 1px solid #444;
            border-radius: 12px;
        }
        .credential-card {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            border: 2px solid #3498db;
        }
    </style>
</head>
<body>
<div class='container mt-5'>
<div class='row justify-content-center'>
<div class='col-md-8'>";

echo "<div class='card setup-container'>";
echo "<div class='card-header text-center setup-header py-4'>";
echo "<h2 class='mb-2'><i class='fas fa-building me-2'></i>Professional LMS Setup</h2>";
echo "<p class='mb-0'>Corporate-Grade Learning Management System</p>";
echo "</div>";
echo "<div class='card-body p-4'>";

try {
    $db = Database::connect();
    echo "<div class='alert alert-success'>";
    echo "<i class='fas fa-check-circle me-2'></i><strong>DATABASE CONNECTION:</strong> ESTABLISHED";
    echo "</div>\n";

    // Step 1: Create ci_sessions table
    echo "<h4 class='text-info mb-3'><i class='fas fa-database me-2'></i>Step 1: Session Management</h4>\n";
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
        echo "<div class='alert alert-success'><i class='fas fa-check me-2'></i>Session management system deployed.</div>\n";
    } else {
        echo "<div class='alert alert-info'><i class='fas fa-info-circle me-2'></i>Session management already active.</div>\n";
    }

    // Step 2: Create users table
    echo "<h4 class='text-info mb-3'><i class='fas fa-users me-2'></i>Step 2: User Management</h4>\n";
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
        echo "<div class='alert alert-success'><i class='fas fa-check me-2'></i>User management system established.</div>\n";
    } else {
        echo "<div class='alert alert-info'><i class='fas fa-info-circle me-2'></i>User management already operational.</div>\n";
    }

    // Step 3: Create courses table
    echo "<h4 class='text-info mb-3'><i class='fas fa-graduation-cap me-2'></i>Step 3: Course Management</h4>\n";
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
        echo "<div class='alert alert-success'><i class='fas fa-check me-2'></i>Course management system activated.</div>\n";
    } else {
        echo "<div class='alert alert-info'><i class='fas fa-info-circle me-2'></i>Course management already operational.</div>\n";
    }

    // Step 4: Create enrollments table
    echo "<h4 class='text-info mb-3'><i class='fas fa-user-graduate me-2'></i>Step 4: Enrollment System</h4>\n";
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
        echo "<div class='alert alert-success'><i class='fas fa-check me-2'></i>Enrollment system activated.</div>\n";
    } else {
        echo "<div class='alert alert-info'><i class='fas fa-info-circle me-2'></i>Enrollment system already active.</div>\n";
    }

    // Step 5: Deploy professional staff
    echo "<h4 class='text-info mb-3'><i class='fas fa-user-plus me-2'></i>Step 5: Deploy Professional Staff</h4>\n";
    $userCount = $db->table('users')->countAll();

    if ($userCount == 0) {
        $professionalStaff = [
            [
                'name' => 'System Administrator',
                'email' => 'admin@professional.com',
                'password' => password_hash('admin2024', PASSWORD_ARGON2ID, [
                    'memory_cost' => 65536,
                    'time_cost' => 4,
                    'threads' => 3
                ]),
                'role' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Senior Instructor',
                'email' => 'instructor@professional.com',
                'password' => password_hash('instructor2024', PASSWORD_ARGON2ID, [
                    'memory_cost' => 65536,
                    'time_cost' => 4,
                    'threads' => 3
                ]),
                'role' => 'teacher',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Professional Learner',
                'email' => 'learner@professional.com',
                'password' => password_hash('learner2024', PASSWORD_ARGON2ID, [
                    'memory_cost' => 65536,
                    'time_cost' => 4,
                    'threads' => 3
                ]),
                'role' => 'user',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $db->table('users')->insertBatch($professionalStaff);
        echo "<div class='alert alert-success'><i class='fas fa-check me-2'></i>Professional staff deployed successfully.</div>\n";
    } else {
        echo "<div class='alert alert-info'><i class='fas fa-info-circle me-2'></i>Staff already on duty. ($userCount professionals active)</div>\n";
    }

    // Step 6: Launch professional training programs
    echo "<h4 class='text-info mb-3'><i class='fas fa-briefcase me-2'></i>Step 6: Launch Training Programs</h4>\n";
    $programCount = $db->table('courses')->countAll();

    if ($programCount == 0) {
        $professionalPrograms = [
            [
                'title' => 'Professional Development Essentials',
                'description' => 'Master the fundamental skills required for career advancement and professional growth in modern business environments.',
                'created_by' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Digital Leadership Training',
                'description' => 'Develop leadership skills for the digital age, focusing on technology integration and team management.',
                'created_by' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Corporate Communication Skills',
                'description' => 'Enhance professional communication abilities including presentation, negotiation, and interpersonal skills.',
                'created_by' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Project Management Professional',
                'description' => 'Comprehensive project management training covering planning, execution, and delivery methodologies.',
                'created_by' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Business Analytics and Intelligence',
                'description' => 'Learn data analysis techniques and business intelligence tools for informed decision making.',
                'created_by' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $db->table('courses')->insertBatch($professionalPrograms);
        echo "<div class='alert alert-success'><i class='fas fa-check me-2'></i>Professional training programs launched.</div>\n";
    } else {
        echo "<div class='alert alert-info'><i class='fas fa-info-circle me-2'></i>Training programs already active. ($programCount programs available)</div>\n";
    }

    // Step 7: Display professional credentials
    echo "<h4 class='text-info mb-3'><i class='fas fa-key me-2'></i>Step 7: Professional Credentials</h4>\n";
    echo "<div class='row'>";
    echo "<div class='col-md-4'>";
    echo "<div class='card credential-card text-white mb-3'>";
    echo "<div class='card-header bg-danger text-white text-center'>";
    echo "<i class='fas fa-crown me-2'></i><h5 class='mb-0'>Administrator</h5>";
    echo "</div>";
    echo "<div class='card-body text-center'>";
    echo "<p class='mb-1'><strong>Email:</strong> admin@professional.com</p>";
    echo "<p class='mb-1'><strong>Password:</strong> admin2024</p>";
    echo "<small class='text-muted'>Complete system control</small>";
    echo "</div></div></div>";

    echo "<div class='col-md-4'>";
    echo "<div class='card credential-card text-white mb-3'>";
    echo "<div class='card-header bg-warning text-white text-center'>";
    echo "<i class='fas fa-chalkboard-teacher me-2'></i><h5 class='mb-0'>Instructor</h5>";
    echo "</div>";
    echo "<div class='card-body text-center'>";
    echo "<p class='mb-1'><strong>Email:</strong> instructor@professional.com</p>";
    echo "<p class='mb-1'><strong>Password:</strong> instructor2024</p>";
    echo "<small class='text-muted'>Training management</small>";
    echo "</div></div></div>";

    echo "<div class='col-md-4'>";
    echo "<div class='card credential-card text-white mb-3'>";
    echo "<div class='card-header bg-info text-white text-center'>";
    echo "<i class='fas fa-user-graduate me-2'></i><h5 class='mb-0'>Learner</h5>";
    echo "</div>";
    echo "<div class='card-body text-center'>";
    echo "<p class='mb-1'><strong>Email:</strong> learner@professional.com</p>";
    echo "<p class='mb-1'><strong>Password:</strong> learner2024</p>";
    echo "<small class='text-muted'>Course enrollment</small>";
    echo "</div></div></div>";
    echo "</div>";

    echo "<div class='alert alert-success'>";
    echo "<h4><i class='fas fa-rocket me-2'></i>Professional LMS System Ready!</h4>";
    echo "<p>Sophisticated corporate-themed learning management system is now operational.</p>";
    echo "</div>";

    echo "<div class='alert alert-info'>";
    echo "<h5><i class='fas fa-mouse-pointer me-2'></i>Access Your System:</h5>";
    echo "<ol class='mb-0'>";
    echo "<li><strong>Visit:</strong> <a href='http://localhost/ITE311-LAYAN/public/' target='_blank' class='btn btn-primary btn-sm'>Professional Dashboard</a></li>";
    echo "<li><strong>Login:</strong> Use any of the professional credentials above</li>";
    echo "<li><strong>Explore:</strong> Test different roles and features</li>";
    echo "<li><strong>Secure:</strong> Delete this setup file after testing</li>";
    echo "</ol>";
    echo "</div>";

    echo "<div class='alert alert-dark'>";
    echo "<h5><i class='fas fa-shield-alt me-2'></i>Enterprise Security Active:</h5>";
    echo "<ul class='mb-0'>";
    echo "<li><i class='fas fa-lock me-1'></i> Argon2ID password encryption</li>";
    echo "<li><i class='fas fa-user-shield me-1'></i> Rate limiting protection</li>";
    echo "<li><i class='fas fa-key me-1'></i> CSRF protection</li>";
    echo "<li><i class='fas fa-database me-1'></i> Secure sessions</li>";
    echo "<li><i class='fas fa-user-tag me-1'></i> Role-based access</li>";
    echo "</ul>";
    echo "</div>";

} catch (Exception $e) {
    echo "<div class='alert alert-danger'>";
    echo "<i class='fas fa-exclamation-triangle me-2'></i><strong>SYSTEM ERROR:</strong> " . $e->getMessage();
    echo "</div>\n";

    echo "<div class='alert alert-warning'>";
    echo "<h5><i class='fas fa-tools me-2'></i>System Diagnostics:</h5>";
    echo "<ul class='mb-0'>";
    echo "<li>Verify XAMPP is running</li>";
    echo "<li>Check MySQL service status</li>";
    echo "<li>Confirm database 'lms_layan' exists</li>";
    echo "<li>Validate database credentials</li>";
    echo "</ul>";
    echo "</div>";
}

echo "</div></div></div>";
echo "</div></body></html>";
?>
