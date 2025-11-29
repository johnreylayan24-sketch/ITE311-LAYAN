<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LMS Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #1a1a2e;
            --accent: #4e73df;
            --light: #f8f9fc;
            --dark: #2c3e50;
            --gray: #6c757d;
            --gray-light: #e9ecef;
        }
        
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 1rem;
            background: #f8f9fc;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: #333;
            box-sizing: border-box;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 2rem;
        }

        .login-form {
            width: 100%;
        }

        .login-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .login-header h2 {
            color: #2c3e50;
            margin: 0 0 0.5rem 0;
            font-size: 1.5rem;
        }

        .login-header p {
            color: var(--gray);
            margin-bottom: 0;
        }

        .form-control {
            padding: 0.65rem 1rem;
            border: 1px solid #ddd;
            border-radius: 0.375rem;
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.15);
        }

        .input-group-text {
            background-color: white;
            border-right: none;
            color: var(--gray);
        }

        .form-control.is-invalid:focus, .was-validated .form-control:invalid:focus {
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.15);
        }

        .btn-login {
            background-color: #4e73df;
            border: none;
            padding: 0.7rem;
            font-weight: 500;
            width: 100%;
            margin: 1rem 0;
            border-radius: 0.375rem;
            color: white;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(44, 62, 80, 0.2);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .form-text a {
            color: var(--accent);
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .form-text a:hover {
            color: #2e59d9;
            text-decoration: underline;
        }

        .alert {
            border: none;
            border-radius: 0.5rem;
            padding: 1rem 1.25rem;
            font-size: 0.9rem;
        }

        .alert-danger {
            background-color: #fde8e8;
            color: #c53030;
        }

        .invalid-feedback {
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        @media (max-width: 576px) {
            .login-container {
                margin: 0;
                padding: 1.5rem;
                border-radius: 0;
                box-shadow: none;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="welcome-section">
        <h1>Welcome Back</h1>
        <p>Sign in to continue</p>
    </div>
    
    <div class="login-form">
        <div class="login-header">
            <h2>Sign In</h2>
            <p>Enter your details below</p>
        </div>

        <!-- Flash messages -->
        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('auth/login') ?>" method="post" class="needs-validation" novalidate>
            <?= csrf_field() ?>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="form-label fw-medium">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email"
                           class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>"
                           id="email"
                           name="email"
                           value="<?= old('email') ?>"
                           placeholder="Enter your email"
                           required>
                    <?php if(session('errors.email')): ?>
                        <div class="invalid-feedback">
                            <?= session('errors.email') ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <label for="password" class="form-label fw-medium mb-0">Password</label>
                    <a href="<?= site_url('auth/forgot-password') ?>" class="small text-muted text-decoration-none">
                        Forgot password?
                    </a>
                </div>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password"
                           class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>"
                           id="password"
                           name="password"
                           placeholder="Enter your password"
                           required>
                    <?php if(session('errors.password')): ?>
                        <div class="invalid-feedback">
                            <?= session('errors.password') ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label small" for="remember">
                    Remember me
                </label>
            </div>

            <!-- Login Button -->
            <div class="d-grid gap-2 mb-4">
                <button type="submit" class="btn btn-primary btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Sign In
                </button>
            </div>

            <!-- Divider -->
            <div class="d-flex align-items-center my-4">
                <hr class="flex-grow-1">
                <span class="px-3 text-muted small">OR</span>
                <hr class="flex-grow-1">
            </div>

            <!-- Register Link -->
            <div class="text-center">
                <p class="mb-0">Don't have an account? 
                    <a href="<?= site_url('auth/register') ?>" class="fw-medium">Create account</a>
                </p>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Form validation
    (function () {
        'use strict'
        
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')
        
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                
                form.classList.add('was-validated')
            }, false)
        })
    })()
    
    // Toggle password visibility
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.querySelector('.toggle-password');
        const password = document.querySelector('#password');
        
        if (togglePassword && password) {
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        }
    });
</script>
</body>
</html>
