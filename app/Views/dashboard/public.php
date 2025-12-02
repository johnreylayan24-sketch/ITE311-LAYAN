<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITE311-LAYAN - Learning Management System</title>
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
        }

        .navbar {
            background: #667eea;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
        }

        .navbar-brand {
            font-weight: 700;
            color: white !important;
            font-size: 1.5rem;
            text-decoration: none;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .main-container {
            padding: 60px 20px;
            text-align: center;
        }

        .hero-card {
            background: #667eea;
            border-radius: 20px;
            padding: 60px 40px;
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 20px;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 40px;
        }

        .btn-primary {
            background: white;
            color: #667eea;
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 50px;
            text-decoration: none;
            display: inline-block;
            margin: 10px;
            transition: transform 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            color: #667eea;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid white;
            color: white;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 50px;
            text-decoration: none;
            display: inline-block;
            margin: 10px;
            transition: all 0.2s;
        }

        .btn-outline:hover {
            background: white;
            color: #667eea;
            transform: translateY(-2px);
        }

        .features {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-top: 60px;
            flex-wrap: wrap;
        }

        .feature {
            text-align: center;
            max-width: 200px;
            background: #667eea;
            padding: 30px 20px;
            border-radius: 15px;
            color: white;
        }

        .feature i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: white;
        }

        .feature h4 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: white;
        }

        .feature p {
            font-size: 0.9rem;
            opacity: 0.9;
            margin: 0;
            color: white;
        }

        @media (max-width: 768px) {
            .hero-card {
                padding: 40px 20px;
                margin: 20px;
            }
            
            .hero-title {
                font-size: 2rem;
            }
            
            .features {
                gap: 30px;
            }
        }
    </style>
</head>
<body>
    <!-- Simple Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="<?= base_url('/') ?>" class="navbar-brand">
                <i class="fas fa-graduation-cap me-2"></i>ITE311-LAYAN
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-container">
        <div class="hero-card">
            <h1 class="hero-title">
                <i class="fas fa-graduation-cap me-3"></i>Welcome to ITE311-LAYAN
            </h1>
            <p class="hero-subtitle">Your complete learning management system</p>
            
            <div>
                <a href="<?= base_url('auth/login') ?>" class="btn-primary">
                    <i class="fas fa-sign-in-alt me-2"></i>Login to Dashboard
                </a>
                <a href="<?= base_url('auth/register') ?>" class="btn-outline">
                    <i class="fas fa-user-plus me-2"></i>Create Account
                </a>
            </div>
        </div>

        <div class="features">
            <div class="feature">
                <i class="fas fa-users"></i>
                <h4>Multi-Role</h4>
                <p>Admin, Teacher & Student access</p>
            </div>
            <div class="feature">
                <i class="fas fa-chart-line"></i>
                <h4>Analytics</h4>
                <p>Track progress & performance</p>
            </div>
            <div class="feature">
                <i class="fas fa-book-open"></i>
                <h4>Interactive</h4>
                <p>Engaging learning experience</p>
            </div>
        </div>
    </div>
</body>
</html>
