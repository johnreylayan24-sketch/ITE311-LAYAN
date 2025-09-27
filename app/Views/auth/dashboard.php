<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ITE311-LAYAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --text-primary: #2d3748;
            --text-secondary: #4a5568;
            --accent-color: #667eea;
        }
        
        body {
            background: var(--primary-gradient);
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            color: var(--text-primary);
            line-height: 1.6;
        }

        .navbar {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--glass-border);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            color: white !important;
            font-size: 1.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid var(--glass-border);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .btn-glass {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            color: white;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-glass:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            color: white;
        }

        .alert-success {
            background: rgba(72, 187, 120, 0.2);
            color: white;
            border: 1px solid rgba(72, 187, 120, 0.3);
        }

        .alert-danger {
            background: rgba(245, 101, 101, 0.2);
            color: white;
            border: 1px solid rgba(245, 101, 101, 0.3);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/') ?>">
                <i class="fas fa-graduation-cap me-2"></i>ITE311-LAYAN
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/') ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/about') ?>">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/contact') ?>">Contact</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i><?= esc($user['name']) ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= base_url('/logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-8">
                <div class="glass-card mb-4">
                    <div class="card-body p-4">
                        <h2 class="h3 mb-4 text-white">
                            <i class="fas fa-tachometer-alt me-2"></i>Welcome to Your Dashboard
                        </h2>
                        <div class="text-white">
                            <p class="lead">Hello, <strong><?= esc($user['name']) ?></strong>!</p>
                            <p>You are successfully logged in to the ITE311-LAYAN system.</p>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="glass-card p-3 mb-3">
                                        <h5 class="text-white"><i class="fas fa-envelope me-2"></i>Email</h5>
                                        <p class="mb-0"><?= esc($user['email']) ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="glass-card p-3 mb-3">
                                        <h5 class="text-white"><i class="fas fa-user-tag me-2"></i>Role</h5>
                                        <p class="mb-0"><?= esc($user['role'] ?? 'User') ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="glass-card">
                    <div class="card-body p-4">
                        <h3 class="h5 mb-4 text-white"><i class="fas fa-history me-2"></i>Recent Activity</h3>
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-4x mb-3" style="color: rgba(255, 255, 255, 0.3);"></i>
                            <p class="text-white-50">No recent activity to display.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="glass-card mb-4">
                    <div class="card-body p-4">
                        <h4 class="h5 mb-4 text-white"><i class="fas fa-bolt me-2"></i>Quick Actions</h4>
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-glass">
                                <i class="fas fa-edit me-2"></i>Edit Profile
                            </a>
                            <a href="#" class="btn btn-glass">
                                <i class="fas fa-key me-2"></i>Change Password
                            </a>
                            <a href="<?= base_url('/logout') ?>" class="btn btn-glass">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                        </div>
                    </div>
                </div>

                <div class="glass-card">
                    <div class="card-body p-4">
                        <h4 class="h5 mb-4 text-white"><i class="fas fa-info-circle me-2"></i>System Info</h4>
                        <ul class="list-unstyled text-white">
                            <li class="mb-2"><i class="fas fa-check me-2 text-success"></i>System Status: Online</li>
                            <li class="mb-2"><i class="fas fa-clock me-2"></i>Last Login: <?= date('M d, Y H:i') ?></li>
                            <li class="mb-2"><i class="fas fa-shield-alt me-2"></i>Security: Enabled</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <span class="text-white">© 2025 ITE311-LAYAN. All rights reserved.</span>
        </div>
    </footer>
</body>
</html>
