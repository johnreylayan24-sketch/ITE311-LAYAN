<?php
// Database creation script
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'lms_layan';

try {
    // Create connection without database
    $conn = new mysqli($host, $username, $password);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    
    if ($conn->query($sql) === TRUE) {
        echo "Database '$database' created successfully or already exists.<br>";
        
        // Switch to the database
        $conn->select_db($database);
        
        // Create users table for authentication
        $users_table = "CREATE TABLE IF NOT EXISTS `users` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(100) NOT NULL,
            `email` VARCHAR(100) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `role` VARCHAR(20) NOT NULL DEFAULT 'student',
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            UNIQUE KEY `email` (`email`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
        
        if ($conn->query($users_table) === TRUE) {
            echo "Table 'users' created successfully.<br>";
            
            // Insert a default admin user
            $admin_password = password_hash('admin123', PASSWORD_DEFAULT);
            $check_admin = "SELECT * FROM users WHERE email = 'admin@layan.com'";
            $result = $conn->query($check_admin);
            
            if ($result->num_rows == 0) {
                $insert_admin = "INSERT INTO `users` (name, email, password, role) VALUES ('Admin User', 'admin@layan.com', '$admin_password', 'admin')";
                if ($conn->query($insert_admin) === TRUE) {
                    echo "Default admin user created.<br>";
                    echo "Email: admin@layan.com<br>";
                    echo "Password: admin123<br>";
                }
            } else {
                echo "Admin user already exists.<br>";
            }
            
            // Insert a default student user
            $student_password = password_hash('student123', PASSWORD_DEFAULT);
            $check_student = "SELECT * FROM users WHERE email = 'student@layan.com'";
            $result = $conn->query($check_student);
            
            if ($result->num_rows == 0) {
                $insert_student = "INSERT INTO `users` (name, email, password, role) VALUES ('Student User', 'student@layan.com', '$student_password', 'student')";
                if ($conn->query($insert_student) === TRUE) {
                    echo "Default student user created.<br>";
                    echo "Email: student@layan.com<br>";
                    echo "Password: student123<br>";
                }
            } else {
                echo "Student user already exists.<br>";
            }
        } else {
            echo "Error creating table: " . $conn->error . "<br>";
        }
        
    } else {
        echo "Error creating database: " . $conn->error . "<br>";
    }
    
    $conn->close();
    
    echo "<br><strong>Database setup completed!</strong><br>";
    echo "You can now access the application at: <a href='http://localhost/ITE311-LAYAN/public/'>http://localhost/ITE311-LAYAN/public/</a><br>";
    echo "<br><strong>Default Login Credentials:</strong><br>";
    echo "Admin: admin@layan.com / admin123<br>";
    echo "Student: student@layan.com / student123<br>";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
