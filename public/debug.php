<?php
// Simple database connection test
echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Login Debug - ITE311</title>";
echo "<style>";
echo "body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }";
echo "h1 { color: #333; border-bottom: 3px solid #007bff; padding-bottom: 10px; }";
echo "h2 { color: #495057; margin-top: 30px; }";
echo "table { background: white; border-collapse: collapse; width: 100%; margin: 10px 0; }";
echo "th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }";
echo "th { background-color: #007bff; color: white; }";
echo ".success { color: green; font-weight: bold; }";
echo ".error { color: red; font-weight: bold; }";
echo ".info { background: #e9ecef; padding: 15px; border-left: 4px solid #007bff; margin: 10px 0; }";
echo "a { text-decoration: none; padding: 8px 15px; margin: 5px; border-radius: 4px; }";
echo ".btn-primary { background: #007bff; color: white; }";
echo ".btn-secondary { background: #6c757d; color: white; }";
echo ".btn-success { background: #28a745; color: white; }";
echo "pre { background: #f8f9fa; padding: 10px; border: 1px solid #dee2e6; overflow-x: auto; }";
echo "</style>";
echo "</head>";
echo "<body>";
echo "<h1>🔍 DATABASE CONNECTION TEST</h1>";

// Test database connection manually
echo "<h2>1. Manual Database Connection Test</h2>";
try {
    $config = [
        'DSN'      => '',
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'ite311_layan',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'utf8mb4',
        'DBCollat' => 'utf8mb4_general_ci',
    ];

    $db = new mysqli($config['hostname'], $config['username'], $config['password'], $config['database']);

    if ($db->connect_error) {
        echo "<p style='color: red;'>❌ Database connection: FAILED</p>";
        echo "<p>Error: " . $db->connect_error . "</p>";
    } else {
        echo "<p style='color: green;'>✅ Database connection: SUCCESS</p>";
        echo "<p>Database: " . $config['database'] . "</p>";

        // Check users table
        $result = $db->query("SELECT COUNT(*) as count FROM users");
        if ($result) {
            $row = $result->fetch_assoc();
            echo "<p>Users in database: " . $row['count'] . "</p>";

            if ($row['count'] > 0) {
                echo "<h3>Available Users:</h3>";
                echo "<table border='1' style='border-collapse: collapse;'>";
                echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Password Hash</th></tr>";

                $users = $db->query("SELECT id, name, email, role, password FROM users");
                while ($user = $users->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $user['id'] . "</td>";
                    echo "<td>" . $user['name'] . "</td>";
                    echo "<td>" . $user['email'] . "</td>";
                    echo "<td>" . $user['role'] . "</td>";
                    echo "<td style='font-family: monospace; font-size: 10px;'>" . substr($user['password'], 0, 50) . "...</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        } else {
            echo "<p style='color: red;'>❌ Could not query users table</p>";
            echo "<p>MySQL Error: " . $db->error . "</p>";
        }

        // Check courses table
        $courseResult = $db->query("SELECT COUNT(*) as count FROM courses");
        if ($courseResult) {
            $courseRow = $courseResult->fetch_assoc();
            echo "<p>Courses in database: " . $courseRow['count'] . "</p>";
        }

        $db->close();
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Database error: " . $e->getMessage() . "</p>";
}

echo "<h2>2. Password Test</h2>";
$plainPassword = 'student123';
$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);
$verify = password_verify($plainPassword, $hashedPassword);

echo "<p>Plain password: " . $plainPassword . "</p>";
echo "<p>Hashed password: " . $hashedPassword . "</p>";
echo "<p>Password verify test: " . ($verify ? '✅ PASS' : '❌ FAIL') . "</p>";

echo "<p><a href='index.php' style='background: green; color: white; padding: 10px; text-decoration: none; margin: 5px;'>🏠 Back to Application</a></p>";
echo "<p><a href='auth/login' style='background: blue; color: white; padding: 10px; text-decoration: none; margin: 5px;'>🔐 Go to Login Form</a></p>";
echo "<p><a href='auth/dashboard' style='background: orange; color: white; padding: 10px; text-decoration: none; margin: 5px;'>📊 Try Dashboard Direct</a></p>";
echo "</body>";
echo "</html>";
?>
