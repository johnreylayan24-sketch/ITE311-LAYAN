<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - ITE311-LAYAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: white;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            color: black;
            display: flex;
        }

        .sidebar {
            width: 280px;
            background: white;
            min-height: 100vh;
            padding: 25px;
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.08);
            border-right: 1px solid #e3f2fd;
        }

        .sidebar-brand {
            font-weight: 600;
            color: white !important;
            font-size: 1.1rem;
            text-decoration: none;
            display: block;
            margin-bottom: 30px;
            padding: 15px;
            border-radius: 10px;
            background: #3498db;
            text-align: center;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.2);
        }

        .sidebar-brand i {
            display: block;
            font-size: 1.8rem;
            margin-bottom: 8px;
        }

        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin-bottom: 12px;
        }

        .nav-link {
            color: #2c3e50 !important;
            text-decoration: none;
            padding: 15px 18px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.9rem;
            background: #e3f2fd;
            box-shadow: 0 2px 8px rgba(52, 152, 219, 0.1);
        }

        .nav-link:hover {
            background: #bbdefb;
            color: #1565c0 !important;
            transform: translateX(3px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.15);
        }

        .nav-link.active {
            background: #3498db;
            color: white !important;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }

        .nav-link i {
            width: 22px;
            text-align: center;
            margin-right: 15px;
            font-size: 1rem;
        }

        .main-content {
            flex: 1;
            padding: 30px;
            background: #f8f9fa;
        }

        .dashboard-header {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: transform 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .stat-icon {
            font-size: 2rem;
            color: #3498db;
            margin-bottom: 10px;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 3px;
        }

        .stat-label {
            color: #7f8c8d;
            font-size: 0.8rem;
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                min-height: auto;
                padding: 15px;
            }
            
            .main-content {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <a href="<?= base_url('teacher/dashboard') ?>" class="sidebar-brand">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Teacher Portal</span>
        </a>
        
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="<?= base_url('teacher/dashboard') ?>" class="nav-link active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('teacher/classes') ?>" class="nav-link">
                    <i class="fas fa-chalkboard"></i>
                    <span>My Classes</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('teacher/assignments') ?>" class="nav-link">
                    <i class="fas fa-tasks"></i>
                    <span>Assignments</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('teacher/gradebook') ?>" class="nav-link">
                    <i class="fas fa-book"></i>
                    <span>Gradebook</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('teacher/messages') ?>" class="nav-link">
                    <i class="fas fa-envelope"></i>
                    <span>Messages</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('auth/logout') ?>" class="nav-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard-header">
            <h1><i class="fas fa-chalkboard-teacher me-3"></i><?= $title ?></h1>
            <p class="text-muted mb-0">Welcome back, <?= $user['name'] ?>!</p>
        </div>

        <?php if (isset($teacher_features)): ?>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chalkboard"></i>
                    </div>
                    <div class="stat-number"><?= count($teacher_features['my_courses']) ?></div>
                    <div class="stat-label">My Classes</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number"><?= array_sum(array_column($teacher_features['my_courses'], 'students')) ?></div>
                    <div class="stat-label">Total Students</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="stat-number"><?= $teacher_features['pending_submissions'] ?></div>
                    <div class="stat-label">Pending Reviews</div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
