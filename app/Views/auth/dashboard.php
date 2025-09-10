<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="mb-4">Welcome to the Dashboard 🎉</h2>
            <p>You are logged in as: <strong><?= session()->get('user_name'); ?></strong></p>
            <a href="<?= base_url('auth/logout') ?>" class="btn btn-danger">Logout</a>
        </div>
    </div>
</body>
</html>
