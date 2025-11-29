<?php
// Database verification script
echo "<h1>🔍 DATABASE VERIFICATION</h1>";

try {
    $db = mysqli_connect('localhost', 'root', '', 'ite311_layan');

    if ($db->connect_error) {
        echo "<p style='color: red; font-size: 18px;'>❌ DATABASE CONNECTION FAILED</p>";
        echo "<p>Error: " . $db->connect_error . "</p>";
        echo "<p>Make sure XAMPP MySQL is running!</p>";
    } else {
        echo "<p style='color: green; font-size: 18px;'>✅ DATABASE CONNECTION SUCCESS</p>";

        // Check users
        $result = $db->query("SELECT COUNT(*) as count FROM users");
        if ($result) {
            $row = $result->fetch_assoc();
            echo "<p>Users in database: " . $row['count'] . "</p>";

            if ($row['count'] > 0) {
                echo "<h3>User Accounts:</h3>";
                echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
                echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th></tr>";

                $users = $db->query("SELECT id, name, email, role FROM users");
                while ($user = $users->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $user['id'] . "</td>";
                    echo "<td>" . $user['name'] . "</td>";
                    echo "<td>" . $user['email'] . "</td>";
                    echo "<td>" . $user['role'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p style='color: red;'>❌ No users found in database!</p>";
            }
        }

        // Check courses
        $courseResult = $db->query("SELECT COUNT(*) as count FROM courses");
        if ($courseResult) {
            $courseRow = $courseResult->fetch_assoc();
            echo "<p>Courses in database: " . $courseRow['count'] . "</p>";
        }

        $db->close();
    }
} catch (Exception $e) {
    echo "<p style='color: red; font-size: 18px;'>❌ DATABASE ERROR</p>";
    echo "<p>" . $e->getMessage() . "</p>";
}

echo "<h2>🎯 TESTING STEPS</h2>";
echo "<ol>";
echo "<li><strong>Check Database Status Above</strong></li>";
echo "<li>If database shows RED: Start XAMPP MySQL</li>";
echo "<li>If no users: Run migrations and seeders again</li>";
echo "<li>Visit: <a href='http://localhost:8080/auth/login'>Login Page</a></li>";
echo "<li>Try login with: layan@gmail.com / student123</li>";
echo "</ol>";

echo "<h2>🔧 TROUBLESHOOTING</h2>";
echo "<p><strong>If still not working:</strong></p>";
echo "<ul>";
echo "<li>Check browser console (F12) for JavaScript errors</li>";
echo "<li>Check Network tab for failed requests</li>";
echo "<li>Clear browser cache and cookies</li>";
echo "<li>Try different browser</li>";
echo "</ul>";

echo "<hr>";
echo "<p><a href='index.php' style='background: green; color: white; padding: 10px; text-decoration: none;'>🏠 Back to Application</a></p>";
?>
