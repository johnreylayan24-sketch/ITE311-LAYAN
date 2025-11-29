<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?? 'LMS Admin' ?></title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
        }
        
        body {
            font-size: .875rem;
            background-color: #f8f9fc;
        }
        
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 250px;
            z-index: 1000;
            padding: 0;
            background: #fff;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            transition: all 0.3s ease;
            overflow-y: auto;
            height: 100vh;
        }
        
        .sidebar-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            background: #fff;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 70px;
            display: flex;
            align-items: center;
        }
        
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #4e73df;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.875rem;
        }
        
        .user-info {
            margin-left: 0.75rem;
            line-height: 1.2;
        }
        
        .user-info .fw-bold {
            font-size: 0.875rem;
            margin-bottom: 0.1rem;
        }
        
        .user-info small {
            font-size: 0.75rem;
            color: #858796;
        }
        
        .sidebar .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            margin: 0.25rem 0;
            color: #4e73df;
            font-weight: 600;
            border-radius: 0.35rem;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link:hover {
            background-color: #f8f9fc;
            color: #224abe;
        }
        
        .sidebar .nav-link.active {
            background-color: #eaecf4;
            color: #4e73df;
        }
        
        .sidebar .nav-link i {
            margin-right: 0.5rem;
            width: 20px;
            text-align: center;
        }
        
        .sidebar .nav-item {
            margin-bottom: 0.25rem;
        }
        
        .sidebar .nav-link.active i {
            color: var(--primary-color);
        }
        
        .sidebar-brand {
            color: #fff;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            padding: 0.5rem 0;
        }
        
        .sidebar-brand-icon {
            font-size: 1.5rem;
            margin-right: 0.5rem;
        }
        
        .sidebar-brand-text {
            font-size: 1rem;
        }
        
        .sidebar-divider {
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            margin: 1rem 0;
            opacity: 0.5;
        }
        
        .sidebar-heading {
            font-size: .75rem;
            text-transform: uppercase;
            color: #b7b9cc;
            font-weight: 800;
            padding: 0 1rem;
            margin-top: 1rem;
        }
        
        .navbar {
            background-color: #fff;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            padding: 0.5rem 1rem;
        }
        
        .topbar {
            height: 4.375rem;
        }
        
        .topbar .dropdown-list {
            padding: 0;
            border: none;
            overflow: hidden;
            width: 20rem;
        }
        
        .topbar .dropdown-list .dropdown-header {
            background-color: var(--primary-color);
            border: 1px solid var(--primary-color);
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
            color: #fff;
        }
        
        .card {
            border: none;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 1.25rem;
        }
        
        .card-body {
            padding: 1.25rem;
        }
        
        .bg-gradient-primary {
            background-color: #4e73df;
            background-image: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            background-size: cover;
        }
        
        .text-primary {
            color: var(--primary-color) !important;
        }
        
        .border-left-primary {
            border-left: 0.25rem solid var(--primary-color) !important;
        }
        
        .border-left-success {
            border-left: 0.25rem solid var(--success-color) !important;
        }
        
        .border-left-info {
            border-left: 0.25rem solid var(--info-color) !important;
        }
        
        .border-left-warning {
            border-left: 0.25rem solid var(--warning-color) !important;
        }
        
        .text-success {
            color: var(--success-color) !important;
        }
        
        .text-info {
            color: var(--info-color) !important;
        }
        
        .text-warning {
            color: var(--warning-color) !important;
        }
        
        .text-danger {
            color: var(--danger-color) !important;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2653d4;
        }
        
        .btn-success {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }
        
        .btn-info {
            background-color: var(--info-color);
            border-color: var(--info-color);
        }
        
        .btn-warning {
            background-color: var(--warning-color);
            border-color: var(--warning-color);
            color: #fff;
        }
        
        .btn-danger {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table th {
            border-top: none;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.04em;
            color: #5a5c69;
        }
        
        .table td {
            vertical-align: middle;
        }
        
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #4e73df;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.1rem;
            text-transform: uppercase;
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            padding: 0.5rem 0;
        }
        
        .dropdown-item {
            padding: 0.5rem 1.5rem;
            font-size: 0.85rem;
        }
        
        .dropdown-item i {
            margin-right: 0.5rem;
            width: 1.2em;
            text-align: center;
        }
        
        .dropdown-divider {
            margin: 0.25rem 0;
            border-top: 1px solid #eaecf4;
        }
        
        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
            font-size: 75%;
        }
        
        .badge-primary {
            background-color: #e0e7ff;
            color: #4f46e5;
        }
        
        .badge-success {
            background-color: #d1fae5;
            color: #059669;
        }
        
        .badge-warning {
            background-color: #fef3c7;
            color: #d97706;
        }
        
        .badge-danger {
            background-color: #fee2e2;
            color: #dc2626;
        }
        
        .alert {
            border: none;
            border-left: 4px solid transparent;
            border-radius: 0.35rem;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
        }
        
        .alert-dismissible .btn-close {
            padding: 1rem 1.25rem;
        }
        
        .alert-primary {
            background-color: #e0e7ff;
            border-left-color: #4f46e5;
            color: #4f46e5;
        }
        
        .alert-success {
            background-color: #d1fae5;
            border-left-color: #059669;
            color: #059669;
        }
        
        .alert-warning {
            background-color: #fef3c7;
            border-left-color: #d97706;
            color: #d97706;
        }
        
        .alert-danger {
            background-color: #fee2e2;
            border-left-color: #dc2626;
            color: #dc2626;
        }
        
        .form-control, .form-select {
            border: 1px solid #d1d3e2;
            border-radius: 0.35rem;
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
            height: calc(1.5em + 0.75rem + 2px);
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #bac8f3;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        
        .form-label {
            font-weight: 600;
            font-size: 0.8rem;
            margin-bottom: 0.5rem;
            color: #5a5c69;
        }
        
        .form-text {
            font-size: 0.75rem;
            color: #858796;
        }
        
        .invalid-feedback {
            font-size: 0.75rem;
        }
        
        .was-validated .form-control:invalid, .form-control.is-invalid {
            border-color: #e74a3b;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23e74a3b'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23e74a3b' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        
        .was-validated .form-control:valid, .form-control.is-valid {
            border-color: #1cc88a;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%231cc88a' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        
        .btn-sm, .btn-group-sm > .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }
        
        .btn-xs {
            padding: 0.15rem 0.35rem;
            font-size: 0.7rem;
            line-height: 1.2;
            border-radius: 0.15rem;
        }
        
        .pagination .page-link {
            color: var(--primary-color);
            border: 1px solid #e3e6f0;
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
        }
        
        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .pagination .page-item.disabled .page-link {
            color: #b7b9cc;
        }
        
        .custom-control-input:checked ~ .custom-control-label::before {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .custom-switch .custom-control-input:checked ~ .custom-control-label::after {
            background-color: #fff;
            transform: translateX(0.75rem);
        }
        
        .custom-control-label::before {
            background-color: #eaecf4;
            border: #b7b9cc solid 1px;
        }
        
        .custom-control-label::after {
            background-color: #fff;
        }
        
        .custom-file-label {
            border: 1px solid #d1d3e2;
            border-radius: 0.35rem;
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
            height: calc(1.5em + 0.75rem + 2px);
        }
        
        .custom-file-label::after {
            background-color: #eaecf4;
            border-left: 1px solid #d1d3e2;
            color: #6e707e;
            padding: 0.5rem 1rem;
            height: calc(1.5em + 0.75rem);
        }
        
        .custom-select {
            background-color: #fff;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%235a5c69' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-position: right 0.75rem center;
            background-repeat: no-repeat;
            background-size: 16px 12px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }
        
        .custom-select.is-invalid, .was-validated .custom-select:invalid {
            border-color: #e74a3b;
            padding-right: 3rem;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%235a5c69' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e"), url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23e74a3b'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23e74a3b' stroke='none'/%3e%3c/svg%3e");
            background-position: right 0.75rem center, center right 2.25rem;
            background-size: 16px 12px, calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        
        .custom-select.is-valid, .was-validated .custom-select:valid {
            border-color: #1cc88a;
            padding-right: 3rem;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%235a5c69' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e"), url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%231cc88a' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
            background-position: right 0.75rem center, center right 2.25rem;
            background-size: 16px 12px, calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        
        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1050;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .sidebar-content {
                padding-bottom: 80px;
            }
            
            .content-wrapper {
                padding: 1rem;
            }
        }
        
        /* Print styles */
        @media print {
            .no-print {
                display: none !important;
            }
            
            .card, .table {
                border: 1px solid #e3e6f0;
            }
            
            .table-responsive {
                overflow-x: visible;
            }
            
            body {
                background-color: #fff !important;
            }
            
            .container {
                max-width: 100%;
                padding: 0;
            }
            
            .card {
                border: none;
                box-shadow: none;
            }
            
            .card-header {
                background-color: transparent !important;
                border-bottom: 1px solid #e3e6f0;
            }
        }
        
        #content-wrapper {
            width: calc(100% - 250px);
            margin-left: 250px;
            min-height: 100vh;
            transition: all 0.3s;
            padding-top: 60px;
            background-color: #f8f9fc;
        }
        
        /* When sidebar is toggled on mobile */
        body.sidebar-toggled #content-wrapper {
            width: 100%;
            margin-left: 0;
        }
        
        @media (max-width: 768px) {
            #content-wrapper {
                width: 100%;
                margin-left: 0;
                padding-top: 60px;
            }
            
            .sidebar {
                transform: translateX(-100%);
            }
            
            body.sidebar-toggled .sidebar {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-header">
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin/dashboard') ?>">
                    <div class="sidebar-brand-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="sidebar-brand-text mx-2">LMS Admin</div>
                </a>
                <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Items -->
            <div class="sidebar-content">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/dashboard') ?>" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item mt-2">
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mb-1 text-muted">
                            <span>Management</span>
                        </h6>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/users') ?>">
                            <i class="fas fa-fw fa-users"></i>
                            <span>Users</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/courses') ?>">
                            <i class="fas fa-fw fa-book"></i>
                            <span>Courses</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/categories') ?>">
                            <i class="fas fa-fw fa-tags"></i>
                            <span>Categories</span>
                        </a>
                    </li>

                    <li class="nav-item mt-2">
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mb-1 text-muted">
                            <span>Reports</span>
                        </h6>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/reports') ?>">
                            <i class="fas fa-fw fa-chart-bar"></i>
                            <span>Reports</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/logs') ?>">
                            <i class="fas fa-fw fa-clipboard-list"></i>
                            <span>Activity Logs</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="sidebar-footer mt-auto">
                <div class="d-flex align-items-center px-3 py-2">
                    <div class="user-avatar me-2">
                        <?= strtoupper(substr(session()->get('user_name') ?? 'A', 0, 1)) ?>
                    </div>
                    <div class="user-info">
                        <div class="fw-bold"><?= session()->get('user_name') ?? 'Admin' ?></div>
                        <small class="text-muted"><?= ucfirst(session()->get('user_role') ?? 'Admin') ?></small>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm py-0 fixed-top" style="height: 60px; z-index: 900; margin-left: 250px; width: calc(100% - 250px);">
                <div class="container-fluid px-4">
                    <button class="btn btn-link d-md-none" id="sidebarToggleMobile">
                        <i class="fas fa-bars"></i>
                    </button>

                    <!-- Search Bar -->
                    <form class="d-none d-md-flex ms-3">
                        <div class="input-group">
                            <input class="form-control" type="search" placeholder="Search..." aria-label="Search">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                    <div class="ms-auto d-flex align-items-center">
                        <!-- Notifications -->
                        <div class="dropdown me-3">
                            <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bell fa-lg"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    3+
                                    <span class="visually-hidden">unread notifications</span>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg-end p-0" style="min-width: 20rem;">
                                <div class="dropdown-header bg-light">
                                    <h6 class="m-0">Notifications</h6>
                                </div>
                                <div class="list-group list-group-flush">
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">New user registered</h6>
                                            <small class="text-muted">5 mins ago</small>
                                        </div>
                                        <p class="mb-1">A new user has registered on the platform.</p>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">System update</h6>
                                            <small class="text-muted">2 hours ago</small>
                                        </div>
                                        <p class="mb-1">System maintenance scheduled for tonight.</p>
                                    </a>
                                </div>
                                <div class="dropdown-footer text-center">
                                    <a href="#" class="text-decoration-none">View all notifications</a>
                                </div>
                            </div>
                        </div>

                        <!-- Messages -->
                        <div class="dropdown me-3">
                            <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-envelope fa-lg"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    7
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end p-0" style="min-width: 25rem;">
                                <div class="dropdown-header bg-light">
                                    <h6 class="m-0">Messages</h6>
                                </div>
                                <div class="list-group list-group-flush" style="max-height: 300px; overflow-y: auto;">
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100">
                                            <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="User">
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between">
                                                    <h6 class="mb-1">John Doe</h6>
                                                    <small class="text-muted">3 mins ago</small>
                                                </div>
                                                <p class="mb-0 text-truncate">Hey there! I was wondering if you could help me with a problem I've been having.</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100">
                                            <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="User">
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between">
                                                    <h6 class="mb-1">Jane Smith</h6>
                                                    <small class="text-muted">1 hour ago</small>
                                                </div>
                                                <p class="mb-0 text-truncate">I've completed the task you assigned me.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-footer text-center">
                                    <a href="#" class="text-decoration-none">View all messages</a>
                                </div>
                            </div>
                        </div>

                        <!-- User Dropdown -->
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-avatar me-2">
                                    <?= strtoupper(substr(session()->get('user_name') ?? 'A', 0, 1)) ?>
                                </div>
                                <span class="d-none d-lg-inline"><?= session()->get('user_name') ?? 'Admin' ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><h6 class="dropdown-header">Welcome, <?= session()->get('user_name') ?? 'Admin' ?></h6></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= base_url('admin/profile') ?>"><i class="fas fa-user fa-fw me-2"></i> Profile</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('admin/settings') ?>"><i class="fas fa-cog fa-fw me-2"></i> Settings</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('admin/activity') ?>"><i class="fas fa-history fa-fw me-2"></i> Activity Log</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="<?= base_url('logout') ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="dropdown-item text-danger" style="background: none; border: none; width: 100%; text-align: left;">
                                            <i class="fas fa-sign-out-alt fa-fw me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div id="content" class="py-4 px-4">
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
                    
                    <?php if (session()->getFlashdata('warning')): ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('warning') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (session()->getFlashdata('info')): ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('info') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Main Content -->
                    <?= $this->renderSection('content') ?>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website <?= date('Y') ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('logout') ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom scripts for all pages-->
    <script>
        // Toggle the side navigation
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarToggleMobile = document.getElementById('sidebarToggleMobile');
            const contentWrapper = document.getElementById('content-wrapper');
            
            // Toggle sidebar on desktop
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.body.classList.toggle('sidebar-toggled');
                    
                    if (document.body.classList.contains('sidebar-toggled')) {
                        localStorage.setItem('sb|sidebar-toggled', 'true');
                    } else {
                        localStorage.setItem('sb|sidebar-toggled', 'false');
                    }
                    
                    // Adjust content wrapper width
                    if (window.innerWidth > 768) {
                        if (document.body.classList.contains('sidebar-toggled')) {
                            contentWrapper.style.marginLeft = '0';
                            contentWrapper.style.width = '100%';
                        } else {
                            contentWrapper.style.marginLeft = '250px';
                            contentWrapper.style.width = 'calc(100% - 250px)';
                        }
                    }
                });
            }
            
            // Toggle sidebar on mobile
            if (sidebarToggleMobile) {
                sidebarToggleMobile.addEventListener('click', function(e) {
                    e.preventDefault();
                    sidebar.classList.toggle('show');
                    
                    // Toggle body class for mobile overlay
                    if (window.innerWidth <= 768) {
                        document.body.classList.toggle('sidebar-toggled');
                    }
                });
            }
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(e) {
                const isClickInsideSidebar = sidebar.contains(e.target);
                const isClickOnToggle = (sidebarToggleMobile && sidebarToggleMobile.contains(e.target)) || 
                                      (sidebarToggle && sidebarToggle.contains(e.target));
                
                if (!isClickInsideSidebar && !isClickOnToggle && window.innerWidth <= 768 && sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                    document.body.classList.remove('sidebar-toggled');
                }
            });
            
            // Handle window resize
            function handleResize() {
                if (window.innerWidth <= 768) {
                    contentWrapper.style.width = '100%';
                    contentWrapper.style.marginLeft = '0';
                    document.querySelector('.navbar').style.width = '100%';
                    document.querySelector('.navbar').style.marginLeft = '0';
                    if (!document.body.classList.contains('sidebar-toggled')) {
                        sidebar.style.transform = 'translateX(-100%)';
                    } else {
                        document.body.classList.remove('sidebar-toggled');
                        sidebar.classList.remove('toggled');
                    }
                } else {
                    // On mobile, ensure desktop toggled state is removed
                    document.body.classList.remove('sidebar-toggled');
                    sidebar.classList.remove('toggled');
                }
                
                // Close any open dropdowns on mobile
                if (window.innerWidth < 768) {
                    const openDropdowns = document.querySelectorAll('.sidebar .collapse.show');
                    openDropdowns.forEach(function(dropdown) {
                        dropdown.classList.remove('show');
                    });
                }
            }
            
            // Initial check
            handleResize();
            
            // Add resize event listener
            window.addEventListener('resize', handleResize);

            // Prevent content scrolling when sidebar is open on mobile
            document.querySelector('.sidebar').addEventListener('mousewheel', function(e) {
                if (this.scrollTop === 0 && e.deltaY < 0) {
                    e.preventDefault();
                } else if (this.scrollHeight === this.scrollTop + this.clientHeight && e.deltaY > 0) {
                    e.preventDefault();
                }
            });

            // Add active class to current nav item
            const currentLocation = window.location.pathname + window.location.search;
            const menuItems = document.querySelectorAll('.sidebar .nav-link');
            
            menuItems.forEach(function(item) {
                const itemHref = item.getAttribute('href');
                if (itemHref && currentLocation.includes(itemHref) && itemHref !== '#') {
                    item.classList.add('active');
                    
                    // Also make sure to expand the parent dropdown if it exists
                    const parent = item.closest('.collapse');
                    if (parent) {
                        parent.classList.add('show');
                        const parentItem = parent.closest('.nav-item');
                        if (parentItem) {
                            const toggle = parentItem.querySelector('[data-bs-toggle="collapse"]');
                            if (toggle) {
                                toggle.setAttribute('aria-expanded', 'true');
                                toggle.classList.remove('collapsed');
                            }
                        }
                    }
                }
            });
        });
        
        // Close sidebar when a nav link is clicked on mobile
        const navLinks = document.querySelectorAll('.sidebar .nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    const sidebar = document.querySelector('.sidebar');
                    sidebar.classList.remove('show');
                    document.body.classList.remove('sidebar-toggled');
                }
            });
        });
        
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Initialize popovers
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
        
        // Auto-hide alerts after 5 seconds
        var alertList = document.querySelectorAll('.alert');
        alertList.forEach(function(alert) {
            setTimeout(function() {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
        
                
                // If it's a dropdown item, also mark the parent as active
                var parent = menuItem.parentElement;
                while (parent && parent !== document) {
                    if (parent.classList.contains('collapse')) {
                        parent.classList.add('show');
                        var parentLink = document.querySelector('[data-bs-target="#' + parent.id + '"]');
                        if (parentLink) {
                            parentLink.setAttribute('aria-expanded', 'true');
                            parentLink.classList.add('active');
                        }
                    }
                    parent = parent.parentElement;
                }
            }
        });
        
        // Enable tooltips everywhere
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
    
    <?= $this->renderSection('scripts') ?>
</body>
</html>
