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
            padding: 40px;
            background: white;
        }

        .dashboard-header {
            background: #3498db;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.2);
            color: white;
        }

        .dashboard-header h1 {
            color: white;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .dashboard-header p {
            color: rgba(255, 255, 255, 0.9);
            margin: 0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: #e3f2fd;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(52, 152, 219, 0.1);
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid #bbdefb;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.2);
            background: #bbdefb;
        }

        .stat-icon {
            font-size: 2.5rem;
            color: #3498db;
            margin-bottom: 15px;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #1565c0;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #2c3e50;
            font-size: 0.9rem;
        }

        .content-box {
            background: #e3f2fd;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(52, 152, 219, 0.1);
            margin-bottom: 25px;
            color: #2c3e50;
            border: 1px solid #bbdefb;
            transition: all 0.3s ease;
        }

        .content-box:hover {
            background: #bbdefb;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.2);
        }

        .content-box h3 {
            color: #1565c0;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .content-box p {
            color: #2c3e50;
            margin: 0;
        }

        .action-box {
            background: #bbdefb;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(52, 152, 219, 0.1);
            margin-bottom: 20px;
            color: #1565c0;
            border: 1px solid #90caf9;
            transition: all 0.3s ease;
        }

        .action-box:hover {
            background: #90caf9;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.2);
        }

        .action-box h4 {
            color: #1565c0;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .action-box p {
            color: #2c3e50;
            margin: 0;
            font-size: 0.9rem;
        }

        .info-box {
            background: #e3f2fd;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(52, 152, 219, 0.1);
            margin-bottom: 20px;
            color: #1565c0;
            border: 1px solid #bbdefb;
            transition: all 0.3s ease;
        }

        .info-box:hover {
            background: #bbdefb;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.2);
        }

        .info-box h4 {
            color: #1565c0;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .info-box p {
            color: #2c3e50;
            margin: 0;
            font-size: 0.9rem;
        }

        .light-box {
            background: #f5f5f5;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            color: #2c3e50;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .light-box:hover {
            background: #e8eaf6;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .light-box h4 {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .light-box p {
            color: #34495e;
            margin: 0;
            font-size: 0.9rem;
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
                padding: 20px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <a href="<?= base_url('dashboard') ?>" class="sidebar-brand">
            <i class="fas fa-graduation-cap"></i>
            <span>ITE311-LAYAN</span>
        </a>
        
        <ul class="nav-menu">
            <!-- Admin Navigation -->
            <li class="nav-item">
                <a href="<?= base_url('dashboard') ?>" class="nav-link active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('users') ?>" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('courses') ?>" class="nav-link">
                    <i class="fas fa-book"></i>
                    <span>Courses</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('enrollment') ?>" class="nav-link">
                    <i class="fas fa-user-plus"></i>
                    <span>Enrollment</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('reports') ?>" class="nav-link">
                    <i class="fas fa-chart-bar"></i>
                    <span>Reports</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('settings') ?>" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
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
            <h1><i class="fas fa-tachometer-alt me-3"></i><?= $title ?></h1>
            <p class="mb-0">Welcome back, <?= $user['name'] ?>!</p>
        </div>

        <?php if ($user['role'] === 'admin' && isset($admin_features)): ?>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="stat-number"><?= $admin_features['total_users'] ?></div>
                    <div class="stat-label">Total Courses</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-number">85%</div>
                    <div class="stat-label">Completion Rate</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="stat-number">12</div>
                    <div class="stat-label">Achievements</div>
                </div>
            </div>
        <?php endif; ?>

        <div class="content-box">
            <h3><i class="fas fa-chart-line me-2"></i>System Overview</h3>
            <p>Your learning management system is running smoothly with all services operational.</p>
        </div>

        <div class="action-box">
            <h4><i class="fas fa-tasks me-2"></i>Quick Actions</h4>
            <p>Manage users, create courses, and monitor system performance from your admin dashboard.</p>
        </div>

        <div class="info-box">
            <h4><i class="fas fa-info-circle me-2"></i>Recent Activity</h4>
            <p>System updates completed successfully. All user accounts are synchronized.</p>
        </div>

        <div class="light-box">
            <h4><i class="fas fa-bell me-2"></i>Notifications</h4>
            <p>No new system alerts. Everything is functioning normally.</p>
        </div>
    </div>
</body>
</html>
