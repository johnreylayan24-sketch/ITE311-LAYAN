<?php

use CodeIgniter\Router\RouteCollection;

/**XA
 * @var RouteCollection $routes
 */
// Home routes
$routes->get('/', 'Home::index');
$routes->get('about', 'Home::about');
$routes->get('contact', 'Home::contact');

// Authentication routes
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::register');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Auth::dashboard');

// Admin routes
$routes->group('admin', ['filter' => 'auth:admin'], function($routes) {
    $routes->get('users', 'Admin::users');
    $routes->get('courses', 'Admin::courses');
    $routes->get('settings', 'Admin::settings');
    $routes->get('analytics', 'Admin::analytics');
    $routes->get('reports', 'Admin::reports');
});

// Teacher routes
$routes->group('teacher', ['filter' => 'auth:teacher'], function($routes) {
    $routes->get('courses', 'Teacher::courses');
    $routes->get('assignments', 'Teacher::assignments');
    $routes->get('grades', 'Teacher::grades');
    $routes->get('students', 'Teacher::students');
});

// Student routes
$routes->group('student', ['filter' => 'auth:student'], function($routes) {
    $routes->get('courses', 'Student::courses');
    $routes->get('assignments', 'Student::assignments');
    $routes->get('grades', 'Student::grades');
    $routes->get('schedule', 'Student::schedule');
});

// Common user routes
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('profile', 'User::profile');
    $routes->get('settings', 'User::settings');
});
