<?php
// Test session directory permissions
$sessionPath = 'C:\xampp\htdocs\ITE311-LAYAN\writable\session';
echo "Testing session directory: $sessionPath<br>";
echo "Directory exists: " . (is_dir($sessionPath) ? 'Yes' : 'No') . "<br>";
echo "Directory is writable: " . (is_writable($sessionPath) ? 'Yes' : 'No') . "<br>";

// Try to create a test file
$testFile = $sessionPath . '/test_' . time() . '.txt';
if (file_put_contents($testFile, 'test')) {
    echo "Successfully created test file: $testFile<br>";
    unlink($testFile); // Clean up
    echo "Test file deleted successfully<br>";
} else {
    echo "Failed to create test file in session directory<br>";
    echo "Please check directory permissions<br>";
}
?>
