<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - LMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0d0d0d 0%, #1a1a1a 100%);
            font-family: 'Oswald', sans-serif;
            color: #fff;
        }

        .verification-card {
            width: 100%;
            max-width: 500px;
            background: #1c1c1c;
            padding: 3rem;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.7);
            border: 2px solid #ff4500;
            text-align: center;
        }

        .verification-icon {
            font-size: 4rem;
            color: #ff4500;
            margin-bottom: 1.5rem;
        }

        .btn-resend {
            background-color: #ff4500;
            border: none;
            padding: 10px 25px;
            font-weight: 600;
            margin-top: 1.5rem;
            transition: all 0.3s;
        }

        .btn-resend:hover {
            background-color: #e63e00;
            transform: translateY(-2px);
        }

        .verification-text {
            margin: 1.5rem 0;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="verification-card">
        <div class="verification-icon">
            <i class="bi bi-envelope-check"></i>
        </div>
        <h2>Verify Your Email</h2>
        
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="verification-text">
            <p>We've sent a verification link to <strong><?= $email ?? 'your email address' ?></strong>.</p>
            <p>Please check your inbox and click on the link to verify your email address.</p>
        </div>

        <div class="d-flex justify-content-center">
            <a href="<?= site_url('auth/logout') ?>" class="btn btn-outline-light me-2">Logout</a>
            <form action="<?= site_url('auth/verify-email/resend') ?>" method="post">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-resend">
                    <i class="bi bi-arrow-repeat"></i> Resend Verification Email
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
