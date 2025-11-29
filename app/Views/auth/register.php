<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Register - LMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #0f0f0f 0%, #1a1a1a 50%, #0f0f0f 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .register-container {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            border: 1px solid #444;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            backdrop-filter: blur(10px);
        }
        .register-header {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            border-bottom: 2px solid #3498db;
            color: #ecf0f1;
        }
        .btn-register {
            background: linear-gradient(135deg, #2980b9 0%, #3498db 100%);
            border: 1px solid #2980b9;
            border-radius: 8px;
            padding: 14px;
            font-weight: 600;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        .btn-register:hover {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            border-color: #3498db;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.3);
        }
        .form-control {
            border-radius: 8px;
            border: 2px solid #555;
            padding: 14px;
            background: #2c2c2c;
            color: #ecf0f1;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
            background: #333;
            color: #ecf0f1;
        }
        .form-control::placeholder {
            color: #95a5a6;
        }
        .form-label {
            color: #ecf0f1;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }
        .card {
            border-radius: 12px;
            border: none;
            overflow: hidden;
        }
        .alert {
            border-radius: 8px;
            border: none;
        }
        .password-strength {
            font-size: 0.875rem;
            margin-top: 5px;
        }
        .strength-weak { color: #e74c3c; }
        .strength-medium { color: #f39c12; }
        .strength-strong { color: #27ae60; }
        .register-footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            border-top: 1px solid #3498db;
        }
        .form-check-input:checked {
            background-color: #3498db;
            border-color: #3498db;
        }
        .form-check-label {
            color: #ecf0f1;
        }
        .register-decoration {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 20%, rgba(52, 152, 219, 0.08) 0%, transparent 50%),
                        radial-gradient(circle at 70% 80%, rgba(155, 89, 182, 0.08) 0%, transparent 50%);
            pointer-events: none;
=======
    <title>Register - ITE311 LAYAN</title>
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
            display: flex;
            flex-direction: column;
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
        
        .register-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
        }
        
        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
        }
        
        .register-header {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .register-header h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .register-header p {
            opacity: 0.9;
            margin: 0;
        }
        
        .register-body {
            padding: 2rem;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }
        
        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            border: none;
            border-radius: 10px;
            padding: 0.875rem 2rem;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.4);
        }
        
        .alert {
            border: none;
            border-radius: 10px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            color: #166534;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }
        
        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #991b1b;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }
        
        .register-links {
            text-align: center;
            padding: 1.5rem 2rem;
            background: rgba(248, 250, 252, 0.8);
            border-top: 1px solid rgba(226, 232, 240, 0.5);
        }
        
        .register-links a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .register-links a:hover {
            color: var(--accent-color);
        }
        
        .footer {
            background: var(--dark-color);
            color: white;
            padding: 2rem 0;
            margin-top: auto;
        }
        
        .footer h5 {
            color: var(--accent-color);
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .footer p {
            opacity: 0.8;
        }
        
        @media (max-width: 768px) {
            .register-card {
                margin: 1rem;
            }
            
            .register-header {
                padding: 1.5rem;
            }
            
            .register-header h2 {
                font-size: 1.5rem;
            }
            
            .register-body {
                padding: 1.5rem;
            }
>>>>>>> 9bc49831b38c627ac5b7e400f2b51d63a4e97daf
        }
    </style>
</head>
<body>
<<<<<<< HEAD
    <div class="container position-relative">
        <div class="register-decoration"></div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card register-container position-relative">
                    <div class="card-header text-center register-header py-4">
                        <h3 class="mb-2">
                            <i class="fas fa-user-plus me-2"></i>
                            Professional Registration
                        </h3>
                        <small class="text-light">
                            <i class="fas fa-graduation-cap me-1"></i>
                            Join the Learning Management System
                        </small>
                    </div>
                    <div class="card-body p-5">

                        <!-- Flash messages -->
                        <?php if(session()->getFlashdata('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                <?= session()->getFlashdata('success') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <?php if(session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <?= session()->getFlashdata('error') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <?php if(isset($validation)): ?>
                            <div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                Please correct the errors below and try again.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form action="<?= site_url('/auth/register') ?>" method="post" novalidate id="registerForm">
                            <?= csrf_field() ?>

                            <!-- Name Field -->
                            <div class="mb-4">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user me-2 text-primary"></i>Full Name
                                </label>
                                <input type="text"
                                       name="name"
                                       id="name"
                                       class="form-control form-control-lg"
                                       placeholder="Enter your full name"
                                       value="<?= set_value('name') ?>"
                                       required
                                       minlength="3"
                                       maxlength="100"
                                       autocomplete="name">
                                <div class="form-text text-light">
                                    Your display name in the system (3-100 characters)
                                </div>
                                <?php if(isset($validation) && $validation->hasError('name')): ?>
                                    <div class="text-danger small mt-1">
                                        <?= $validation->getError('name') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Email Field -->
                            <div class="mb-4">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-2 text-primary"></i>Email Address
                                </label>
                                <input type="email"
                                       name="email"
                                       id="email"
                                       class="form-control form-control-lg"
                                       placeholder="Enter your email address"
                                       value="<?= set_value('email') ?>"
                                       required
                                       autocomplete="email">
                                <div class="form-text text-light">
                                    We'll never share your email with anyone else
                                </div>
                                <?php if(isset($validation) && $validation->hasError('email')): ?>
                                    <div class="text-danger small mt-1">
                                        <?= $validation->getError('email') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Password Field -->
                            <div class="mb-4">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock me-2 text-primary"></i>Password
                                </label>
                                <input type="password"
                                       name="password"
                                       id="password"
                                       class="form-control form-control-lg"
                                       placeholder="Create a strong password"
                                       required
                                       minlength="8"
                                       maxlength="255"
                                       autocomplete="new-password">
                                <div class="password-strength" id="passwordStrength">
                                    Password strength: <span id="strengthText">Too short</span>
                                </div>
                                <div class="form-text text-light">
                                    Must be at least 8 characters with uppercase, lowercase, numbers, and symbols
                                </div>
                                <?php if(isset($validation) && $validation->hasError('password')): ?>
                                    <div class="text-danger small mt-1">
                                        <?= $validation->getError('password') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Confirm Password Field -->
                            <div class="mb-4">
                                <label for="password_confirm" class="form-label">
                                    <i class="fas fa-lock me-2 text-primary"></i>Confirm Password
                                </label>
                                <input type="password"
                                       name="password_confirm"
                                       id="password_confirm"
                                       class="form-control form-control-lg"
                                       placeholder="Confirm your password"
                                       required
                                       autocomplete="new-password">
                                <div class="form-text text-light">
                                    Re-enter your password to confirm
                                </div>
                                <?php if(isset($validation) && $validation->hasError('password_confirm')): ?>
                                    <div class="text-danger small mt-1">
                                        <?= $validation->getError('password_confirm') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Terms and Privacy -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="#" class="text-decoration-none text-info">Terms of Service</a>
                                    and <a href="#" class="text-decoration-none text-info">Privacy Policy</a>
                                </label>
                                <?php if(isset($validation) && $validation->hasError('terms')): ?>
                                    <div class="text-danger small mt-1">
                                        <?= $validation->getError('terms') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Register Button -->
                            <button type="submit" class="btn btn-register w-100 mb-4">
                                <i class="fas fa-user-plus me-2"></i>Create My Account
                            </button>

                            <!-- Login Link -->
                            <div class="text-center">
                                <span class="text-muted">Already have an account? </span>
                                <a href="<?= site_url('/auth/login') ?>" class="text-decoration-none text-info fw-bold">
                                    Sign In Here
                                </a>
                            </div>
                        </form>

                    </div>
                    <div class="card-footer text-center register-footer py-3">
                        <small class="text-light">
                            <i class="fas fa-shield-alt me-1"></i>
                            Secure Professional Registration | Enterprise Grade
                        </small>
                    </div>
                </div>

                <!-- System Features -->
                <div class="text-center mt-4">
                    <div class="row text-center">
                        <div class="col-4">
                            <i class="fas fa-lock text-info fa-2x mb-2"></i>
                            <br>
                            <small class="text-light">Encrypted</small>
                        </div>
                        <div class="col-4">
                            <i class="fas fa-user-shield text-primary fa-2x mb-2"></i>
                            <br>
                            <small class="text-light">Protected</small>
                        </div>
                        <div class="col-4">
                            <i class="fas fa-graduation-cap text-success fa-2x mb-2"></i>
                            <br>
                            <small class="text-light">Learning</small>
                        </div>
                    </div>
                </div>

=======
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/') ?>">
                <i class="fas fa-graduation-cap me-2"></i> ITE311-LAYAN
            </a>
        </div>
    </nav>

    <!-- Register Container -->
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <h2><i class="fas fa-user-plus me-2"></i> Create Account</h2>
                <p>Join our learning community today</p>
            </div>
            
            <div class="register-body">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i> <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li class="small"><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('register') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="mb-4">
                        <label for="name" class="form-label">
                            <i class="fas fa-user me-2"></i> Full Name
                        </label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="<?= old('name') ?>" placeholder="Enter your full name" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-2"></i> Email Address
                        </label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?= old('email') ?>" placeholder="Enter your email" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock me-2"></i> Password
                        </label>
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="Enter your password" required>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirm" class="form-label">
                            <i class="fas fa-lock me-2"></i> Confirm Password
                        </label>
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm" 
                               placeholder="Confirm your password" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-user-plus me-2"></i> Register
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="register-links">
                <p class="mb-0">Already have an account? <a href="<?= base_url('login') ?>">Login here</a></p>
>>>>>>> 9bc49831b38c627ac5b7e400f2b51d63a4e97daf
            </div>
        </div>
    </div>

<<<<<<< HEAD
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('password_confirm');
            const strengthText = document.getElementById('strengthText');
            const registerForm = document.getElementById('registerForm');
            const submitBtn = document.querySelector('.btn-register');

            // Password strength checker
            password.addEventListener('input', function() {
                const value = this.value;
                let strength = 0;
                let feedback = '';

                if (value.length >= 8) strength++;
                if (value.match(/[a-z]/)) strength++;
                if (value.match(/[A-Z]/)) strength++;
                if (value.match(/[0-9]/)) strength++;
                if (value.match(/[^a-zA-Z0-9]/)) strength++;

                switch(strength) {
                    case 0:
                    case 1:
                    case 2:
                        feedback = 'Weak';
                        strengthText.className = 'strength-weak';
                        break;
                    case 3:
                        feedback = 'Medium';
                        strengthText.className = 'strength-medium';
                        break;
                    case 4:
                    case 5:
                        feedback = 'Strong';
                        strengthText.className = 'strength-strong';
                        break;
                }

                strengthText.textContent = value.length === 0 ? 'Too short' : feedback;
            });

            // Password confirmation validation
            confirmPassword.addEventListener('input', function() {
                if (password.value !== this.value) {
                    this.setCustomValidity('Passwords do not match');
                } else {
                    this.setCustomValidity('');
                }
            });

            // Form submission
            registerForm.addEventListener('submit', function(e) {
                if (!document.getElementById('terms').checked) {
                    e.preventDefault();
                    alert('You must agree to the Terms of Service and Privacy Policy');
                    return;
                }

                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating Account...';
                submitBtn.disabled = true;
            });

            // Auto-focus on first field
            document.getElementById('name').focus();

            // Add smooth glow effect to form fields on focus
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.style.boxShadow = '0 0 15px rgba(52, 152, 219, 0.2)';
                });
                input.addEventListener('blur', function() {
                    this.style.boxShadow = 'none';
                });
            });
        });
    </script>
=======
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
                    <p class="mb-0">Designed for excellence in IT education</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
>>>>>>> 9bc49831b38c627ac5b7e400f2b51d63a4e97daf
</body>
</html>
