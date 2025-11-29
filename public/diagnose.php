<?php
// Simple diagnostic script
echo "<h1>CodeIgniter 4 Diagnostic</h1>";
echo "<p>PHP Version: " . PHP_VERSION . "</p>";

// Check if vendor directory exists
echo "<p>Vendor directory: " . (is_dir('../vendor') ? '<span style="color: green;">EXISTS</span>' : '<span style="color: red;">MISSING</span>') . "</p>";

// Check if composer.json is valid
$composerJson = file_get_contents('../composer.json');
$composerData = json_decode($composerJson);
echo "<p>Composer.json valid: " . (json_last_error() === JSON_ERROR_NONE ? '<span style="color: green;">YES</span>' : '<span style="color: red;">NO</span>') . "</p>";

// Check if system directory exists
echo "<p>System directory: " . (is_dir('../system') ? '<span style="color: green;">EXISTS</span>' : '<span style="color: red;">MISSING</span>') . "</p>";

// Check if app directory exists
echo "<p>App directory: " . (is_dir('../app') ? '<span style="color: green;">EXISTS</span>' : '<span style="color: red;">MISSING</span>') . "</p>";

// Test autoloading
echo "<p>Testing autoloading...</p>";
try {
    if (file_exists('../vendor/autoload.php')) {
        require_once '../vendor/autoload.php';
        echo "<p style='color: green;'>✅ Autoloader loaded successfully</p>";

        // Test CodeIgniter classes
        if (class_exists('CodeIgniter\CodeIgniter')) {
            echo "<p style='color: green;'>✅ CodeIgniter class available</p>";
        } else {
            echo "<p style='color: red;'>❌ CodeIgniter class not found</p>";
        }

        // Test database connection
        echo "<p>Testing database connection...</p>";
        $db = db_connect();
        if ($db) {
            echo "<p style='color: green;'>✅ Database connection successful</p>";
            echo "<p>Database: " . $db->getDatabase() . "</p>";

            $tables = $db->listTables();
            echo "<p>Tables: " . implode(', ', $tables) . "</p>";

            if (in_array('users', $tables)) {
                echo "<p style='color: green;'>✅ Users table exists</p>";
            } else {
                echo "<p style='color: red;'>❌ Users table missing</p>";
            }
        } else {
            echo "<p style='color: red;'>❌ Database connection failed</p>";
        }
    } else {
        echo "<p style='color: red;'>❌ Vendor autoloader not found</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<p><strong>Quick Fix Instructions:</strong></p>";
echo "<ol>";
echo "<li>Make sure XAMPP Apache and MySQL are running</li>";
echo "<li>Access via: <code>http://localhost/ITE311-LAYAN/public/</code></li>";
echo "<li>Or use development server: <code>php spark serve</code></li>";
echo "<li>Check database: <code>php spark migrate:status</code></li>";
echo "</ol>";
?>
