<?php
// Test script to check session directory writability
$sessionPath = 'writable/session';

echo "Testing session directory: " . realpath($sessionPath) . "\n";

if (is_dir($sessionPath)) {
    echo "Directory exists\n";
} else {
    echo "Directory does NOT exist\n";
}

if (is_writable($sessionPath)) {
    echo "Directory is writable\n";
    
    // Try to create a test file
    $testFile = $sessionPath . '/test_write.txt';
    $content = 'Test content ' . date('Y-m-d H:i:s');
    
    if (file_put_contents($testFile, $content)) {
        echo "Successfully wrote test file\n";
        echo "File contents: " . file_get_contents($testFile) . "\n";
        
        // Clean up
        unlink($testFile);
        echo "Test file cleaned up\n";
    } else {
        echo "Failed to write test file\n";
    }
} else {
    echo "Directory is NOT writable\n";
    
    // Try to change permissions
    if (chmod($sessionPath, 0755)) {
        echo "Changed directory permissions to 755\n";
    } else {
        echo "Failed to change directory permissions\n";
    }
}

echo "WRITEPATH constant: " . (defined('WRITEPATH') ? WRITEPATH : 'NOT DEFINED') . "\n";
?>
