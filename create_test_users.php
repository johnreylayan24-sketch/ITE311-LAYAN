<?php
// Database connection settings
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'lms_layan'; // Your actual database name

try {
    // Create database connection
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Database connected successfully!<br>";
    
    // Test users data
    $testUsers = [
        [
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'role' => 'admin'
        ],
        [
            'name' => 'Teacher User',
            'email' => 'teacher@gmail.com',
            'password' => 'teacher123',
            'role' => 'teacher'
        ],
        [
            'name' => 'Student User',
            'email' => 'student@gmail.com',
            'password' => 'student123',
            'role' => 'student'
        ]
    ];
    
    // Check if users table exists
    $tableCheck = $conn->query("SHOW TABLES LIKE 'users'");
    if ($tableCheck->rowCount() == 0) {
        echo "Users table does not exist. Please create the users table first.<br>";
        echo "Expected table structure: id, username, email, password, role, created_at<br>";
        exit;
    }
    
    // Insert test users
    foreach ($testUsers as $user) {
        // Check if user already exists
        $checkUser = $conn->prepare("SELECT id FROM users WHERE email = :email");
        $checkUser->bindParam(':email', $user['email']);
        $checkUser->execute();
        
        if ($checkUser->rowCount() > 0) {
            echo "User '{$user['name']}' already exists. Skipping...<br>";
            continue;
        }
        
        // Hash password
        $hashedPassword = password_hash($user['password'], PASSWORD_DEFAULT);
        
        // Insert user
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role, status, created_at) VALUES (:name, :email, :password, :role, :status, NOW())");
        $stmt->bindParam(':name', $user['name']);
        $stmt->bindParam(':email', $user['email']);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $user['role']);
        $status = 'active';
        $stmt->bindParam(':status', $status);
        
        if ($stmt->execute()) {
            echo "✅ User '{$user['name']}' created successfully!<br>";
            echo "   - Name: {$user['name']}<br>";
            echo "   - Email: {$user['email']}<br>";
            echo "   - Password: {$user['password']}<br>";
            echo "   - Role: {$user['role']}<br><br>";
        } else {
            echo "❌ Failed to create user '{$user['name']}'<br>";
        }
    }
    
    echo "<hr>";
    echo "<h3>🎉 Test Users Created Successfully!</h3>";
    echo "<p><strong>IMPORTANT:</strong> Use EMAIL addresses to login (not username)</p>";
    echo "<table border='1' cellpadding='10' class='table table-striped'>";
    echo "<tr><th>Role</th><th>Email (for Login)</th><th>Password</th><th>Name</th></tr>";
    echo "<tr><td>🔴 Admin</td><td>admin@gmail.com</td><td>admin123</td><td>Admin User</td></tr>";
    echo "<tr><td>🔵 Teacher</td><td>teacher@gmail.com</td><td>teacher123</td><td>Teacher User</td></tr>";
    echo "<tr><td>🟢 Student</td><td>student@gmail.com</td><td>student123</td><td>Student User</td></tr>";
    echo "</table>";
    
    echo "<hr>";
    echo "<h3>Testing Instructions:</h3>";
    echo "<ol>";
    echo "<li>Go to <a href='/ITE311-LAYAN/login'>Login Page</a></li>";
    echo "<li>Log in with each user account</li>";
    echo "<li>Verify you are redirected to the dashboard</li>";
    echo "<li>Check that navigation shows correct menu items for each role</li>";
    echo "<li>Test access control by trying different URLs</li>";
    echo "<li>Test logout functionality</li>";
    echo "</ol>";
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
