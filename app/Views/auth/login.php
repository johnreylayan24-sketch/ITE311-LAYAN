<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ITE311-LAYAN</title>
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
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .page-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: white;
            border-bottom: 1px solid #e3f2fd;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 40px;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(52, 152, 219, 0.1);
        }

        .back-to-dashboard {
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 8px;
            background: #e3f2fd;
        }

        .back-to-dashboard:hover {
            color: #2980b9;
            text-decoration: none;
            background: #bbdefb;
            transform: translateY(-1px);
        }

        .back-to-dashboard i {
            font-size: 0.85rem;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 40px;
        }

        .login-card {
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(52, 152, 219, 0.15);
            border: 1px solid #e3f2fd;
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-header h2 {
            font-weight: 600;
            color: #1565c0;
            margin-bottom: 10px;
            font-size: 1.8rem;
        }

        .login-header p {
            color: #2c3e50;
            margin: 0;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 500;
            color: #1565c0;
            margin-bottom: 8px;
            display: block;
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 15px 18px;
            border: 1px solid #bbdefb;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 500;
            background: #e3f2fd;
            color: #2c3e50;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(52, 152, 219, 0.1);
        }

        .form-control:focus {
            outline: none;
            border-color: #3498db;
            background: #bbdefb;
            color: #1565c0;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.2);
        }

        .form-control::placeholder {
            color: #7f8c8d;
        }

        .btn-primary {
            width: 100%;
            padding: 15px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.2);
            text-transform: none;
        }

        .btn-primary:hover {
            background: #2980b9;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            border: 1px solid;
            font-size: 0.9rem;
        }

        .alert-danger {
            background: #ffebee;
            color: #c62828;
            border-color: #ffcdd2;
        }

        .alert-success {
            background: #e8f5e8;
            color: #2e7d32;
            border-color: #c8e6c9;
        }

        .login-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e3f2fd;
        }

        .login-footer a {
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .login-footer a:hover {
            color: #2980b9;
            text-decoration: underline;
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #3498db;
            font-size: 1rem;
        }

        .input-icon .form-control {
            padding-left: 45px;
        }

        .password-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            font-size: 0.85rem;
        }

        .remember-me input[type="checkbox"] {
            margin-right: 8px;
            accent-color: #3498db;
        }

        .remember-me label {
            color: #2c3e50;
            font-weight: 500;
            cursor: pointer;
        }

        .forgot-password a {
            color: #3498db;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #2980b9;
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .page-header {
                padding: 0 20px;
            }
            
            .back-to-dashboard {
                font-size: 0.8rem;
                padding: 6px 12px;
            }
            
            .login-container {
                padding: 20px;
                padding-top: 80px;
            }
            
            .login-card {
                padding: 30px 20px;
            }
            
            .login-header h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="page-header">
        <a href="<?= base_url('/') ?>" class="back-to-dashboard">
            <i class="fas fa-arrow-left"></i>
            Back to Dashboard
        </a>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h2><i class="fas fa-graduation-cap me-2"></i>ITE311-LAYAN</h2>
                <p>Sign in to your account</p>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('auth/login') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope me-2"></i>Email Address
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               class="form-control" 
                               placeholder="Enter your email"
                               value="<?= old('email') ?>"
                               required>
                    </div>
                    <?php if (isset($validation) && $validation->getError('email')): ?>
                        <div class="text-danger mt-1" style="font-size: 0.8rem;">
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            <?= $validation->getError('email') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock me-2"></i>Password
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="form-control" 
                               placeholder="Enter your password"
                               required>
                    </div>
                    <div class="password-options">
                        <div class="remember-me">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember">Remember Me</label>
                        </div>
                        <div class="forgot-password">
                            <a href="<?= base_url('auth/forgot-password') ?>">Forgot Password?</a>
                        </div>
                    </div>
                    <?php if (isset($validation) && $validation->getError('password')): ?>
                        <div class="text-danger mt-1" style="font-size: 0.8rem;">
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            <?= $validation->getError('password') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </button>
            </form>

            <div class="login-footer">
                <p class="mb-0">
                    Don't have an account? 
                    <a href="<?= base_url('auth/register') ?>">
                        <i class="fas fa-user-plus me-1"></i>Create Account
                    </a>
                </p>
            </div>
    </div>
    </div>
</body>
</html>
