<?php
// Quick database check
echo "<h1>Database Status</h1>";

try {
    $db = db_connect();
    if ($db) {
        echo "<p style='color: green;'>✅ Database connection: SUCCESS</p>";
        echo "<p>Database: " . $db->getDatabase() . "</p>";

        // Check users table
        $users = $db->table('users')->select('name, email, role')->get()->getResultArray();
        echo "<h3>Users in Database:</h3>";
        echo "<table border='1' style='border-collapse: collapse;'>";
        echo "<tr><th>Name</th><th>Email</th><th>Role</th></tr>";
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>" . $user['name'] . "</td>";
            echo "<td>" . $user['email'] . "</td>";
            echo "<td>" . $user['role'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        // Check courses table
        $courses = $db->table('courses')->countAll();
        echo "<p>Courses in database: " . $courses . "</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
}
?>
