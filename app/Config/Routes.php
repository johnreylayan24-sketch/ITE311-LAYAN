<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->setAutoRoute(false); // Keep off for security

// Custom 404 page
$routes->set404Override(function($message = null) {
    return view('errors/html/error_404', ['message' => $message]);
});

/*
|--------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------
*/
$routes->group('auth', function($routes) {
    $routes->get('login', 'Auth::login', ['as' => 'login']);
    $routes->post('login', 'Auth::handleLoginAttempt');
    $routes->get('register', 'Auth::register', ['as' => 'register']);
    $routes->post('register', 'Auth::register');
    $routes->get('logout', 'Auth::logout', ['as' => 'logout']);
    $routes->post('logout', 'Auth::logout', ['as' => 'logout']);
});

/*
|--------------------------------------------------------------------
| DASHBOARD ROUTES
|--------------------------------------------------------------------
| Redirect users based on role and protect with auth filter
*/
$routes->get('dashboard', 'Dashboard::index');
$routes->get('teacher/dashboard', 'Teacher\TeacherDashboard::index');
$routes->get('student/dashboard', 'Student\StudentDashboard::index');

/*
|--------------------------------------------------------------------
| DEFAULT ROOT
|--------------------------------------------------------------------
*/
$routes->get('/', 'Dashboard::publicIndex'); // Show public dashboard first
