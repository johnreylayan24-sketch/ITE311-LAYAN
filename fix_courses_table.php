<?php
// Database connection
$host = 'localhost';
$dbname = 'lms_layan';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h3>🔧 Fixing Courses Table</h3>";
    
    // Check if instructor_id column exists
    $stmt = $conn->query("SHOW COLUMNS FROM courses LIKE 'instructor_id'");
    $instructorExists = $stmt->fetch();
    
    // Check if teacher_id column exists
    $stmt = $conn->query("SHOW COLUMNS FROM courses LIKE 'teacher_id'");
    $teacherExists = $stmt->fetch();
    
    echo "<p>instructor_id exists: " . ($instructorExists ? "✅ Yes" : "❌ No") . "</p>";
    echo "<p>teacher_id exists: " . ($teacherExists ? "✅ Yes" : "❌ No") . "</p>";
    
    if ($instructorExists && $teacherExists) {
        // Both columns exist, copy data and drop instructor_id
        echo "<p>Both columns exist. Copying data from instructor_id to teacher_id...</p>";
        $conn->exec("UPDATE courses SET teacher_id = instructor_id WHERE teacher_id IS NULL");
        echo "<p>✅ Data copied</p>";
        
        // Drop foreign key constraint first
        echo "<p>Dropping foreign key constraint...</p>";
        $conn->exec("ALTER TABLE courses DROP FOREIGN KEY courses_instructor_id_foreign");
        echo "<p>✅ Foreign key constraint dropped</p>";
        
        // Drop instructor_id column
        echo "<p>Dropping instructor_id column...</p>";
        $conn->exec("ALTER TABLE courses DROP COLUMN instructor_id");
        echo "<p>✅ instructor_id column dropped</p>";
        
        // Add foreign key constraint
        echo "<p>Adding foreign key constraint...</p>";
        $conn->exec("ALTER TABLE courses ADD CONSTRAINT courses_teacher_id_foreign FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE CASCADE");
        echo "<p>✅ Foreign key constraint added</p>";
        
    } elseif ($instructorExists && !$teacherExists) {
        // Only instructor_id exists
        echo "<p>Adding teacher_id column...</p>";
        $conn->exec("ALTER TABLE courses ADD COLUMN teacher_id INT(11) UNSIGNED AFTER id");
        echo "<p>✅ teacher_id column added</p>";
        
        // Copy data from instructor_id to teacher_id
        echo "<p>Copying data from instructor_id to teacher_id...</p>";
        $conn->exec("UPDATE courses SET teacher_id = instructor_id");
        echo "<p>✅ Data copied</p>";
        
        // Drop instructor_id column
        echo "<p>Dropping instructor_id column...</p>";
        $conn->exec("ALTER TABLE courses DROP COLUMN instructor_id");
        echo "<p>✅ instructor_id column dropped</p>";
        
        // Add foreign key constraint
        echo "<p>Adding foreign key constraint...</p>";
        $conn->exec("ALTER TABLE courses ADD CONSTRAINT courses_teacher_id_foreign FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE CASCADE");
        echo "<p>✅ Foreign key constraint added</p>";
        
    } elseif ($teacherExists) {
        echo "<p>✅ teacher_id column already exists and instructor_id doesn't exist</p>";
    } else {
        echo "<p>❌ Neither instructor_id nor teacher_id exists</p>";
    }
    
    // Show final table structure
    echo "<hr>";
    echo "<h3>Final Courses Table Structure:</h3>";
    $stmt = $conn->query("DESCRIBE courses");
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
    echo "<h3>✅ Courses Table Fixed Successfully!</h3>";
    echo "<p>The courses table now uses 'teacher_id' instead of 'instructor_id'.</p>";
    
} catch(PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>
