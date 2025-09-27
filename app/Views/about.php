<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - ITE311 LAYAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #64748b;
            --accent-color: #0ea5e9;
            --dark-color: #1e293b;
            --light-bg: #f8fafc;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: var(--dark-color);
        }
        
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
            font-size: 1.4rem;
        }
        
        .nav-link {
            font-weight: 500;
            color: var(--secondary-color) !important;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .nav-link:hover, .nav-link.active {
            color: var(--primary-color) !important;
        }
        
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--primary-color);
        }
        
        .main-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            margin: 2rem auto;
            overflow: hidden;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            padding: 3rem 2rem;
            text-align: center;
        }
        
        .hero-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .hero-section p {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .content-section {
            padding: 3rem 2rem;
        }
        
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 1.5rem;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            border: none;
            border-radius: 25px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3);
        }
        
        .btn-outline-primary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 25px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline-primary:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
        }
        
        .footer {
            background: var(--dark-color);
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
        }
        
        .footer h5 {
            color: var(--accent-color);
            font-weight: 600;
        }
        
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2rem;
            }
            
            .main-container {
                margin: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/') ?>">
                <i class="fas fa-graduation-cap me-2"></i> ITE311-LAYAN
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/') ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('about') ?>">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('contact') ?>">Contact</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <?php if (session()->get('isLoggedIn')): ?>
                        <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-primary me-2">Dashboard</a>
                        <a href="<?= base_url('logout') ?>" class="btn btn-outline-secondary">Logout</a>
                    <?php else: ?>
                        <a href="<?= base_url('login') ?>" class="btn btn-outline-primary me-2">Login</a>
                        <a href="<?= base_url('register') ?>" class="btn btn-primary">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container" style="margin-top: 100px;">
        <div class="main-container">
            <div class="hero-section">
                <h1>About ITE311-LAYAN</h1>
                <p>A learning management system designed for Information Technology Education</p>
            </div>
            
            <div class="content-section">
                <div class="text-center mb-5">
                    <p class="lead">We offer easy-to-follow courses, lessons, and quizzes to help IT students learn and improve their skills. Our platform provides a comprehensive learning experience tailored for both beginners and advanced learners in the field of Information Technology.</p>
                </div>
                
                <div class="feature-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <h4>IT Courses</h4>
                        <p>Comprehensive courses covering the latest technologies and programming languages.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h4>Structured Lessons</h4>
                        <p>Well-organized lessons designed for effective learning and skill development.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <h4>Interactive Quizzes</h4>
                        <p>Test your knowledge with engaging quizzes and assessments.</p>
                    </div>
                </div>
                
                <div class="text-center mt-5">
                    <?php if (!session()->get('isLoggedIn')): ?>
                        <a href="<?= base_url('register') ?>" class="btn btn-primary me-3">
                            <i class="fas fa-rocket me-2"></i> Get Started
                        </a>
                        <a href="<?= base_url('contact') ?>" class="btn btn-outline-primary">
                            <i class="fas fa-envelope me-2"></i> Contact Us
                        </a>
                    <?php else: ?>
                        <a href="<?= base_url('dashboard') ?>" class="btn btn-primary">
                            <i class="fas fa-tachometer-alt me-2"></i> Go to Dashboard
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-graduation-cap me-2"></i> ITE311-LAYAN</h5>
                    <p>Learning Management System for IT Education</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">&copy; <?= date('Y') ?> ITE311 LAYAN. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
