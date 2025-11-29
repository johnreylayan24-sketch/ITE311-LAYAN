<?php
// Comprehensive diagnostic for CodeIgniter 4 application
echo "<h1>🔍 CodeIgniter 4 Application Diagnostic</h1>";
echo "<p>Diagnosing the 404 Auth controller error...</p>";

// Test 1: Basic environment
echo "<h3>📋 Environment Check</h3>";
echo "<p>Current directory: " . __DIR__ . "</p>";
echo "<p>PHP Version: " . PHP_VERSION . "</p>";
echo "<p>Document Root: " . $_SERVER['DOCUMENT_ROOT'] ?? 'Not set' . "</p>";

// Test 2: Directory structure
echo "<h3>📁 Directory Structure</h3>";
$checks = [
    '../system' => 'System directory (CodeIgniter core)',
    '../app' => 'App directory (Controllers, Models, Views)',
    '../vendor' => 'Vendor directory (Composer dependencies)',
    '../writable' => 'Writable directory (Cache, logs, sessions)'
];

foreach ($checks as $path => $description) {
    $exists = is_dir($path) ? '<span style="color: green;">✅ EXISTS</span>' : '<span style="color: red;">❌ MISSING</span>';
    echo "<p>$description: $exists</p>";
}

// Test 3: Composer dependencies
echo "<h3>🎼 Composer Dependencies</h3>";
if (file_exists('../vendor/autoload.php')) {
    echo "<p style='color: green;'>✅ Composer autoloader found</p>";
    try {
        require_once '../vendor/autoload.php';
        echo "<p style='color: green;'>✅ Autoloader loaded successfully</p>";

        if (class_exists('CodeIgniter\CodeIgniter')) {
            echo "<p style='color: green;'>✅ CodeIgniter framework available</p>";
        } else {
            echo "<p style='color: red;'>❌ CodeIgniter class not found</p>";
        }
    } catch (Exception $e) {
        echo "<p style='color: red;'>❌ Autoloader error: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p style='color: red;'>❌ Composer autoloader missing</p>";
    echo "<p style='color: orange;'>💡 Run: <code>composer install</code></p>";
}

// Test 4: Database connection
echo "<h3>🗄️ Database Connection</h3>";
try {
    if (file_exists('../app/Config/Database.php')) {
        echo "<p style='color: green;'>✅ Database config found</p>";

        // Test database connection
        $db = db_connect();
        if ($db) {
            echo "<p style='color: green;'>✅ Database connection successful</p>";
            echo "<p>Database: " . $db->getDatabase() . "</p>";

            $tables = $db->listTables();
            echo "<p>Tables: " . implode(', ', $tables) . "</p>";

            // Check required tables
            $requiredTables = ['users', 'courses', 'enrollments'];
            foreach ($requiredTables as $table) {
                $status = in_array($table, $tables) ?
                    '<span style="color: green;">✅ EXISTS</span>' :
                    '<span style="color: red;">❌ MISSING</span>';
                echo "<p>$table table: $status</p>";
            }
        } else {
            echo "<p style='color: red;'>❌ Database connection failed</p>";
        }
    } else {
        echo "<p style='color: red;'>❌ Database config missing</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Database error: " . $e->getMessage() . "</p>";
}

// Test 5: Auth controller
echo "<h3>🎮 Auth Controller Test</h3>";
$controllerPath = '../app/Controllers/Auth.php';
if (file_exists($controllerPath)) {
    echo "<p style='color: green;'>✅ Auth controller file exists</p>";

    try {
        require_once $controllerPath;
        if (class_exists('App\Controllers\Auth')) {
            echo "<p style='color: green;'>✅ Auth controller class loaded</p>";

            // Try to instantiate
            $auth = new App\Controllers\Auth();
            echo "<p style='color: green;'>✅ Auth controller instantiated</p>";
        } else {
            echo "<p style='color: red;'>❌ Auth controller class not found</p>";
        }
    } catch (Exception $e) {
        echo "<p style='color: red;'>❌ Auth controller error: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p style='color: red;'>❌ Auth controller file missing</p>";
}

echo "<hr>";
echo "<h2>🔧 SOLUTIONS</h2>";

echo "<h3>Option 1: Use Development Server (Recommended)</h3>";
echo "<pre>cd C:\xampp\htdocs\ITE311-LAYAN<br>php spark serve</pre>";
echo "<p>Then access: <code>http://localhost:8080</code></p>";

echo "<h3>Option 2: Configure XAMPP Apache</h3>";
echo "<p><strong>Method A: Point to public directory</strong></p>";
echo "<pre>DocumentRoot \"C:/xampp/htdocs/ITE311-LAYAN/public\"</pre>";
echo "<p>Access: <code>http://localhost/</code></p>";

echo "<p><strong>Method B: Use root with .htaccess (Current setup)</strong></p>";
echo "<pre>DocumentRoot \"C:/xampp/htdocs/ITE311-LAYAN\"</pre>";
echo "<p>Access: <code>http://localhost/ITE311-LAYAN/</code></p>";
echo "<p>Make sure .htaccess files are enabled in Apache!</p>";

echo "<h3>Option 3: Fix Missing Components</h3>";
echo "<p>If any components are missing:</p>";
echo "<pre>composer install<br>php spark migrate</pre>";

echo "<hr>";
echo "<p><a href='index.php' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>🚀 Try Main Application</a> | ";
echo "<a href='db_test.php' style='background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>🗄️ Database Test</a></p>";
?>
