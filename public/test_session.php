<?php
// Test session functionality
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session
session_start();

// Set a test session variable
$_SESSION['test'] = 'Session is working!';

// Display session information
echo "<h1>Session Test</h1>";
echo "<p>Session ID: " . session_id() . "</p>";
echo "<p>Session Test Value: " . ($_SESSION['test'] ?? 'Not set') . "</p>";

echo "<h2>Session Info</h2>";
echo "<pre>";
print_r(session_save_path());
echo "</pre>";

// Check if session file was created
$sessionFile = session_save_path() . '/sess_' . session_id();
echo "<p>Session file should be at: " . htmlspecialchars($sessionFile) . "</p>";

if (file_exists($sessionFile)) {
    echo "<p style='color: green;'>Session file was created successfully!</p>";
} else {
    echo "<p style='color: red;'>Session file was NOT created. Check permissions on: " . session_save_path() . "</p>";
}
?>
