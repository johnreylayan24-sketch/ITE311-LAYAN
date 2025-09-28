<?php
// Database connection
$host = 'localhost';
$dbname = 'lms_layan';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h3>🔧 Fixing Submissions Table</h3>";
    
    // Check current table structure
    $stmt = $conn->query("DESCRIBE submissions");
    echo "<h4>Current Submissions Table Structure:</h4>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['Field'] . "</td>";
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Null'] . "</td>";
        echo "<td>" . $row['Key'] . "</td>";
        echo "<td>" . $row['Default'] . "</td>";
        echo "<td>" . $row['Extra'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Check if assignment_id column exists
    $stmt = $conn->query("SHOW COLUMNS FROM submissions LIKE 'assignment_id'");
    $assignmentExists = $stmt->fetch();
    
    // Check if course_id column exists
    $stmt = $conn->query("SHOW COLUMNS FROM submissions LIKE 'course_id'");
    $courseExists = $stmt->fetch();
    
    echo "<p>assignment_id exists: " . ($assignmentExists ? "✅ Yes" : "❌ No") . "</p>";
    echo "<p>course_id exists: " . ($courseExists ? "✅ Yes" : "❌ No") . "</p>";
    
    if (!$assignmentExists) {
        echo "<p>Adding assignment_id column...</p>";
        $conn->exec("ALTER TABLE submissions ADD COLUMN assignment_id INT(11) UNSIGNED NULL AFTER quiz_id");
        echo "<p>✅ assignment_id column added</p>";
    }
    
    if (!$courseExists) {
        echo "<p>Adding course_id column...</p>";
        $conn->exec("ALTER TABLE submissions ADD COLUMN course_id INT(11) UNSIGNED NULL AFTER student_id");
        echo "<p>✅ course_id column added</p>";
    }
    
    // Add foreign key constraints
    echo "<p>Adding foreign key constraints...</p>";
    
    try {
        $conn->exec("ALTER TABLE submissions ADD CONSTRAINT submissions_assignment_id_foreign FOREIGN KEY (assignment_id) REFERENCES assignments(id) ON DELETE CASCADE");
        echo "<p>✅ assignment_id foreign key added</p>";
    } catch (Exception $e) {
        echo "<p>⚠️ assignment_id foreign key already exists or failed: " . $e->getMessage() . "</p>";
    }
    
    try {
        $conn->exec("ALTER TABLE submissions ADD CONSTRAINT submissions_course_id_foreign FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE");
        echo "<p>✅ course_id foreign key added</p>";
    } catch (Exception $e) {
        echo "<p>⚠️ course_id foreign key already exists or failed: " . $e->getMessage() . "</p>";
    }
    
    // Show final table structure
    echo "<hr>";
    echo "<h4>Final Submissions Table Structure:</h4>";
    $stmt = $conn->query("DESCRIBE submissions");
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['Field'] . "</td>";
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Null'] . "</td>";
        echo "<td>" . $row['Key'] . "</td>";
        echo "<td>" . $row['Default'] . "</td>";
        echo "<td>" . $row['Extra'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<hr>";
    echo "<h3>✅ Submissions Table Fixed Successfully!</h3>";
    echo "<p>The submissions table now supports both quiz_id and assignment_id columns.</p>";
    
} catch(PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>
