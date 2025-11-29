<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
    <div class="card bg-secondary shadow p-4">
        <h2>Admin Dashboard</h2>
        <p>Welcome, <?= session()->get('user_name'); ?> (Admin)</p>

        <a href="<?= site_url('/auth/logout'); ?>" class="btn btn-danger mt-3">Logout</a>
    </div>
</div>

</body>
</html>
