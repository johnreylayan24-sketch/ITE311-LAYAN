<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ITE311 LAYAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --secondary: #6b7280;
            --light: #f9fafb;
            --dark: #111827;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --red-500: #ef4444;
            --red-100: #fee2e2;
            --green-500: #10b981;
            --blue-500: #3b82f6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--gray-100);
            color: var(--gray-900);
            line-height: 1.5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .login-container {
            width: 100%;
            max-width: 380px;
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 1rem auto;
            transform: scale(0.95);
            transform-origin: center;
        }

        .login-header {
            padding: 1.5rem 1.5rem 1rem;
            text-align: center;
            background: linear-gradient(135deg, var(--primary), #6366f1);
            color: white;
        }

        .login-header h1 {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 0.4rem;
        }

        .login-header p {
            opacity: 0.9;
            font-size: 0.9rem;
            margin: 0;
        }

        .login-body {
            padding: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--gray-700);
            font-size: 0.875rem;
        }

        .form-control {
            width: 100%;
            padding: 0.65rem 0.9rem;
            border: 1px solid var(--gray-300);
            border-radius: 0.5rem;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }

        .password-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray-500);
            cursor: pointer;
            padding: 0.25rem;
        }

        .forgot-password {
            display: block;
            text-align: right;
            font-size: 0.8125rem;
            color: var(--primary);
            text-decoration: none;
            margin-top: 0.5rem;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin: 0.75rem 0;
            font-size: 0.9rem;
        }

        .remember-me input {
            margin-right: 0.5rem;
        }

        .btn-login {
            width: 100%;
            padding: 0.65rem;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 0.5rem;
        }

        .btn-login:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 1.25rem 0;
            color: var(--gray-400);
            font-size: 0.85rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: var(--gray-200);
            margin: 0 1rem;
        }

        .signup-link {
            text-align: center;
            margin-top: 1.25rem;
            font-size: 0.9rem;
            color: var(--gray-600);
        }

        .signup-link a {
            color: var(--primary);
            font-weight: 500;
            text-decoration: none;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.25rem;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
        }

        .alert-danger {
            background-color: var(--red-100);
            color: var(--red-500);
            border: 1px solid #fecaca;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert i {
            margin-right: 0.5rem;
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
            display: none;
        }

        .was-validated .form-control:invalid ~ .invalid-feedback,
        .form-control.is-invalid ~ .invalid-feedback {
            display: block;
        }

        .was-validated .form-control:invalid,
        .form-control.is-invalid {
            border-color: var(--red-500);
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        @media (max-width: 576px) {
            .login-container {
                margin: 0.5rem;
                padding: 1.25rem;
                transform: none;
                max-width: 100%;
                height: 100vh;
                border-radius: 0;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
            
            .login-header h1 {
                font-size: 1.5rem;
            }
            
            .login-body {
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 1.25rem 0;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="<?= base_url('/') ?>" class="text-white text-decoration-none">
                    <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                </a>
                <h1 class="mb-0">Welcome Back</h1>
                <div></div>
            </div>
            <p>Sign in to continue to ITE311 LAYAN</p>
        </div>
        
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        
        <form action="/auth/login" method="post" id="loginForm" class="needs-validation" novalidate>
            <?= csrf_field() ?>
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" 
                       class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>" 
                       id="email" 
                       name="email" 
                       value="<?= old('email') ?>" 
                       placeholder="Enter your email"
                       required>
                <div class="invalid-feedback">
                    <?= session('errors.email') ?? 'Please enter a valid email address' ?>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-wrapper">
                    <input type="password" 
                           class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>" 
                           id="password" 
                           name="password" 
                           placeholder="Enter your password"
                           required>
                    <button type="button" class="password-toggle" id="togglePassword">
                        <i class="far fa-eye"></i>
                    </button>
                </div>
                <a href="/auth/forgot" class="forgot-password">Forgot password?</a>
                <div class="invalid-feedback">
                    <?= session('errors.password') ?? 'Please enter your password' ?>
                </div>
            </div>

            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember me</label>
            </div>

            <button type="submit" class="btn-login">
                Sign In
            </button>
        </form>

        <div class="divider">OR</div>

        <div class="signup-link">
            Don't have an account? <a href="/auth/register">Create account</a>
        </div>
    </div>

    <script>
        // Form validation
        (function () {
            'use strict'
            
            // Fetch the form we want to apply custom validation to
            const form = document.getElementById('loginForm')
            const email = document.getElementById('email')
            const password = document.getElementById('password')
            const togglePassword = document.getElementById('togglePassword')
            
            // Toggle password visibility
            if (togglePassword) {
                togglePassword.addEventListener('click', function () {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password'
                    password.setAttribute('type', type)
                    const icon = this.querySelector('i')
                    icon.classList.toggle('fa-eye')
                    icon.classList.toggle('fa-eye-slash')
                })
            }
            
            // Custom validation
            function validateEmail(input) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
                return re.test(String(input).toLowerCase())
            }
            
            // Form submission
            if (form) {
                form.addEventListener('submit', function (event) {
                    event.preventDefault()
                    let isValid = true
                    
                    // Reset previous validation
                    form.classList.remove('was-validated')
                    email.classList.remove('is-invalid')
                    password.classList.remove('is-invalid')
                    
                    // Validate email
                    if (!email.value || !validateEmail(email.value)) {
                        email.classList.add('is-invalid')
                        isValid = false
                    }
                    
                    // Validate password
                    if (!password.value) {
                        password.classList.add('is-invalid')
                        isValid = false
                    }
                    
                    if (isValid) {
                        form.submit()
                    } else {
                        form.classList.add('was-validated')
                    }
                }, false)
            }
            
            // Real-time validation
            if (email) {
                email.addEventListener('input', function() {
                    if (this.value && !validateEmail(this.value)) {
                        this.classList.add('is-invalid')
                    } else {
                        this.classList.remove('is-invalid')
                    }
                })
            }
            
            if (password) {
                password.addEventListener('input', function() {
                    if (this.value === '') {
                        this.classList.add('is-invalid')
                    } else {
                        this.classList.remove('is-invalid')
                    }
                })
            }
        })()
    </script>
</body>
</html>
