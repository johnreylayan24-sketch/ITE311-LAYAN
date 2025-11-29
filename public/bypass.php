<?php
// Quick login bypass test
echo "<h1>Quick Login Test</h1>";
echo "<p>This will manually set session data to test dashboard access.</p>";

if (isset($_GET['test'])) {
    $session = session();
    $userData = [
        'user_id' => 2,
        'user_name' => 'John Layan',
        'user_role' => 'user',
        'isLoggedIn' => true
    ];

    $session->set($userData);

    echo "<p style='color: green;'>✅ Session set manually</p>";
    echo "<p>Session data:</p>";
    echo "<pre>";
    print_r($session->get());
    echo "</pre>";

    echo "<p><a href='auth/dashboard'>Go to Dashboard</a></p>";
} else {
    echo "<p><a href='?test=1'>Set Session and Test Dashboard</a></p>";
}

echo "<hr>";
echo "<p><a href='index.php'>Back to Application</a></p>";
echo "<p><a href='debug.php'>Debug Info</a></p>";
echo "<p><a href='login_test.php'>Login Test Form</a></p>";
?>
