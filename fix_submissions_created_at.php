<?php
// Database connection
$host = 'localhost';
$dbname = 'lms_layan';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h3>🔧 Adding created_at column to Submissions Table</h3>";
    
    // Check if created_at column exists
    $stmt = $conn->query("SHOW COLUMNS FROM submissions LIKE 'created_at'");
    $createdAtExists = $stmt->fetch();
    
    echo "<p>created_at exists: " . ($createdAtExists ? "✅ Yes" : "❌ No") . "</p>";
    
    if (!$createdAtExists) {
        echo "<p>Adding created_at column...</p>";
        $conn->exec("ALTER TABLE submissions ADD COLUMN created_at DATETIME NULL AFTER submitted_at");
        echo "<p>✅ created_at column added</p>";
        
        // Update existing records to have created_at = submitted_at for backward compatibility
        echo "<p>Updating existing records...</p>";
        $conn->exec("UPDATE submissions SET created_at = submitted_at WHERE created_at IS NULL");
        echo "<p>✅ Existing records updated</p>";
    } else {
        echo "<p>✅ created_at column already exists</p>";
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
    echo "<h3>✅ Submissions Table Updated Successfully!</h3>";
    echo "<p>The submissions table now has the created_at column for proper ordering.</p>";
    
} catch(PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>
