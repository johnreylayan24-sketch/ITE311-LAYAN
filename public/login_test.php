<?php
// Test login process
echo "<h1>Login Process Test</h1>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<h2>POST Data Received:</h2>";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    echo "<h2>Testing Authentication</h2>";

    try {
        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user) {
            echo "<p style='color: green;'>✅ User found: " . $user['name'] . "</p>";
            echo "<p>User role: " . $user['role'] . "</p>";

            if (password_verify($password, $user['password'])) {
                echo "<p style='color: green;'>✅ Password verified successfully!</p>";

                // Test session
                $session = session();
                $userData = [
                    'user_id' => $user['id'],
                    'user_name' => $user['name'],
                    'user_role' => $user['role'],
                    'isLoggedIn' => true
                ];

                $session->set($userData);
                echo "<p style='color: green;'>✅ Session set successfully</p>";
                echo "<p>Redirecting to dashboard...</p>";
                echo "<script>window.location.href = 'auth/dashboard';</script>";
            } else {
                echo "<p style='color: red;'>❌ Password verification failed</p>";
            }
        } else {
            echo "<p style='color: red;'>❌ User not found</p>";
        }
    } catch (Exception $e) {
        echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<h2>Login Test Form</h2>";
    echo "<form method='post'>";
    echo "<p>Email: <input type='email' name='email' value='layan@gmail.com' required></p>";
    echo "<p>Password: <input type='password' name='password' value='student123' required></p>";
    echo "<p><button type='submit'>Test Login</button></p>";
    echo "</form>";
}

echo "<hr>";
echo "<p><a href='index.php'>Back to Application</a></p>";
echo "<p><a href='debug.php'>Back to Debug</a></p>";
?>
