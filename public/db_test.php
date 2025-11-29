<?php
// Simple database connection test
echo "<h1>Database Connection Test</h1>";
echo "<p>Testing database connectivity...</p>";

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

        if (in_array('enrollments', $tables)) {
            echo "<p style='color: green;'>✅ Enrollments table: EXISTS</p>";
        } else {
            echo "<p style='color: red;'>❌ Enrollments table: MISSING</p>";
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
