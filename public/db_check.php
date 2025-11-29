<?php
// Database connection test
echo "<h1>Database Status Check</h1>";

try {
    $db = db_connect();
    if ($db) {
        echo "<p style='color: green;'>✅ Database connection: SUCCESS</p>";
        echo "<p>Database: " . $db->getDatabase() . "</p>";

        $tables = $db->listTables();
        echo "<p>Available tables: " . implode(', ', $tables) . "</p>";

        if (in_array('users', $tables)) {
            echo "<p style='color: green;'>✅ Users table: EXISTS</p>";
            $userCount = $db->table('users')->countAll();
            echo "<p>Users in database: " . $userCount . "</p>";

            if ($userCount > 0) {
                $users = $db->table('users')->select('id, name, email, role')->limit(5)->get()->getResultArray();
                echo "<h3>Sample Users:</h3>";
                echo "<table border='1' style='border-collapse: collapse;'>";
                echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th></tr>";
                foreach ($users as $user) {
                    echo "<tr>";
                    echo "<td>" . $user['id'] . "</td>";
                    echo "<td>" . $user['name'] . "</td>";
                    echo "<td>" . $user['email'] . "</td>";
                    echo "<td>" . $user['role'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        } else {
            echo "<p style='color: red;'>❌ Users table: MISSING</p>";
        }

        if (in_array('courses', $tables)) {
            echo "<p style='color: green;'>✅ Courses table: EXISTS</p>";
            $courseCount = $db->table('courses')->countAll();
            echo "<p>Courses in database: " . $courseCount . "</p>";
        } else {
            echo "<p style='color: red;'>❌ Courses table: MISSING</p>";
        }
    } else {
        echo "<p style='color: red;'>❌ Database connection: FAILED</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<p><a href='index.php'>Back to Application</a></p>";
?>
