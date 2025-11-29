<?php
require_once 'app/Config/Database.php';

echo "=== CodeIgniter Project Setup Verification ===\n\n";

// Test database connection
try {
    $db = \Config\Database::connect();
    echo "✅ Database connection successful\n";
    echo "   Database: " . $db->database . "\n";
    echo "   Host: " . $db->hostname . "\n\n";
} catch (\Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
    exit(1);
}

// Check if users table exists
if ($db->tableExists('users')) {
    echo "✅ Users table exists\n";
    
    // Check table structure
    $forge = \Config\Database::forge();
    $query = $db->query("DESCRIBE users");
    $fields = $query->getResultArray();
    
    echo "\n--- Users Table Structure ---\n";
    foreach ($fields as $field) {
        echo "   {$field['Field']}: {$field['Type']}" . 
             ($field['Null'] === 'NO' ? ' NOT NULL' : ' NULL') . 
             (isset($field['Default']) ? " DEFAULT '{$field['Default']}'" : '') . "\n";
    }
    
    // Check for role column specifically
    $roleField = null;
    foreach ($fields as $field) {
        if ($field['Field'] === 'role') {
            $roleField = $field;
            break;
        }
    }
    
    if ($roleField) {
        echo "\n✅ Role column found\n";
        echo "   Type: {$roleField['Type']}\n";
        
        // Check if it contains the correct enum values
        if (strpos($roleField['Type'], 'admin') !== false && 
            strpos($roleField['Type'], 'teacher') !== false && 
            strpos($roleField['Type'], 'student') !== false) {
            echo "✅ Role column has correct values (admin, teacher, student)\n";
        } else {
            echo "⚠️  Role column may need to be updated\n";
        }
    } else {
        echo "\n❌ Role column not found\n";
    }
    
    // Count existing users
    $query = $db->query("SELECT COUNT(*) as count FROM users");
    $result = $query->getRowArray();
    echo "\n📊 Total users in database: " . $result['count'] . "\n";
    
    // Show users by role if any exist
    if ($result['count'] > 0) {
        $query = $db->query("SELECT role, COUNT(*) as count FROM users GROUP BY role");
        $roleCounts = $query->getResultArray();
        echo "\n--- Users by Role ---\n";
        foreach ($roleCounts as $roleCount) {
            echo "   {$roleCount['role']}: {$roleCount['count']} user(s)\n";
        }
    }
    
} else {
    echo "❌ Users table does not exist\n";
}

echo "\n=== Setup Complete ===\n";
?>
