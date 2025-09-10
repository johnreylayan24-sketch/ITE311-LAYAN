<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <?php 
            // Debug: Check session data
            $success = session()->getFlashdata('success');
            $error = session()->getFlashdata('error');
            $allSession = session()->get();
            
            // Debug: Log session data
            if (PHP_SAPI !== 'cli') {
                error_log('Session data: ' . json_encode($allSession));
                error_log('Success message: ' . ($success ?: 'none'));
                error_log('Error message: ' . ($error ?: 'none'));
            }
            ?>
            
            <?php if ($success): ?>
                <div class="alert alert-success">
                    <?= $success ?>
                </div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <div class="card shadow-lg">
                <div class="card-header text-center">
                    <h3>Create Account</h3>
                </div>
                <div class="card-body">
                    <form action="/register" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control <?php if(isset($validation) && $validation->hasError('name')): ?>is-invalid<?php endif; ?>" value="<?= old('name') ?>" required>
                            <?php if(isset($validation) && $validation->hasError('name')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('name') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control <?php if(isset($validation) && $validation->hasError('email')): ?>is-invalid<?php endif; ?>" value="<?= old('email') ?>" required>
                            <?php if(isset($validation) && $validation->hasError('email')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('email') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control <?php if(isset($validation) && $validation->hasError('password')): ?>is-invalid<?php endif; ?>" required>
                            <?php if(isset($validation) && $validation->hasError('password')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirm" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirm" id="password_confirm" class="form-control <?php if(isset($validation) && $validation->hasError('password_confirm')): ?>is-invalid<?php endif; ?>" required>
                            <?php if(isset($validation) && $validation->hasError('password_confirm')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password_confirm') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p>Already have an account? <a href="/login">Login here</a></p>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>