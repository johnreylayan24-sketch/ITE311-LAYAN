<?php

use CodeIgniter\Router\RouteCollection;

/**XA
 * @var RouteCollection $routes
 */
<<<<<<< HEAD
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->setAutoRoute(false); // Keep off for security

// Custom 404 page (fixed to pass $message)
$routes->set404Override(function($message = null) {
    return view('errors/html/error_404', ['message' => $message]);
});

// CSRF Protection for all POST, PUT, PATCH, DELETE requests
$routes->setDefaultNamespace('App\Controllers');

/*
|--------------------------------------------------------------------------
| HOME CONTROLLER ROUTES
|--------------------------------------------------------------------------
*/
$routes->get('/', 'Home::index', ['as' => 'home']);
$routes->get('/about', 'Home::about', ['as' => 'about']);
$routes->get('/contact', 'Home::contact', ['as' => 'contact']);

/*
|-----------------------------------------------------------------------
| TEMPORARY DATABASE TEST ROUTE
|-----------------------------------------------------------------------
| Used to verify that CodeIgniter can connect to the database
*/
$routes->get('/testdb', 'TestDB::index'); // <-- Your test DB route

/*
|-----------------------------------------------------------------------
| MAIN ROUTE
|-----------------------------------------------------------------------
| Visiting http://localhost:8080/ will redirect to appropriate dashboard if logged in
*/
$routes->get('/', 'Auth::login');

/*
|-----------------------------------------------------------------------
| AUTHENTICATION ROUTES
|-----------------------------------------------------------------------
*/
$routes->group('auth', function ($routes) {
    $routes->get('login', 'Auth::login', ['as' => 'login']);
    $routes->post('login', 'Auth::attemptLogin');
    
    $routes->get('register', 'Auth::register', ['as' => 'register']);
    $routes->post('register', 'Auth::attemptRegister');
    
    $routes->get('forgot-password', 'Auth::forgotPassword', ['as' => 'forgot-password']);
    $routes->post('forgot-password', 'Auth::processForgotPassword');
    
    $routes->get('reset-password/(:segment)', 'Auth::resetPassword/$1', ['as' => 'reset-password']);
    $routes->post('reset-password', 'Auth::processResetPassword', ['as' => 'process-reset']);
    
    // Verify email route with and without token
    $routes->get('verify-email', 'Auth::showVerifyEmail', ['as' => 'show-verify-email']);
    $routes->get('verify-email/(:segment)', 'Auth::verifyEmail/$1', ['as' => 'verify-email']);
    $routes->post('logout', 'Auth::logout', ['as' => 'logout']);
});

/*
|-----------------------------------------------------------------------
| DASHBOARD ROUTE (Unified RBAC)
|-----------------------------------------------------------------------
*/
$routes->get('dashboard', 'Auth::dashboard', ['filter' => 'auth']); // Unified dashboard redirect

// Admin Routes
$routes->group('admin', ['filter' => ['auth', 'role:admin']], function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index', ['as' => 'admin.dashboard']);
    
    $routes->group('users', function ($routes) {
        $routes->get('/', 'Admin\Users::index', ['as' => 'admin.users']);
        $routes->get('create', 'Admin\Users::create', ['as' => 'admin.users.create']);
        $routes->post('store', 'Admin\Users::store', ['as' => 'admin.users.store']);
        $routes->get('edit/(:num)', 'Admin\Users::edit/$1', ['as' => 'admin.users.edit']);
        $routes->post('update/(:num)', 'Admin\Users::update/$1', ['as' => 'admin.users.update']);
        $routes->get('delete/(:num)', 'Admin\Users::delete/$1', ['as' => 'admin.users.delete']);
    });
    
    $routes->group('courses', function ($routes) {
        $routes->get('/', 'Admin\Courses::index', ['as' => 'admin.courses']);
        $routes->get('create', 'Admin\Courses::create', ['as' => 'admin.courses.create']);
        $routes->post('store', 'Admin\Courses::store', ['as' => 'admin.courses.store']);
        $routes->get('edit/(:num)', 'Admin\Courses::edit/$1', ['as' => 'admin.courses.edit']);
        $routes->post('update/(:num)', 'Admin\Courses::update/$1', ['as' => 'admin.courses.update']);
        $routes->get('delete/(:num)', 'Admin\Courses::delete/$1', ['as' => 'admin.courses.delete']);
    });
    
    $routes->get('settings', 'Admin\Settings::index', ['as' => 'admin.settings']);
    $routes->post('settings/update', 'Admin\Settings::update', ['as' => 'admin.settings.update']);
});

// Teacher Routes
$routes->group('teacher', ['filter' => ['auth', 'role:teacher']], function ($routes) {
    $routes->get('dashboard', 'Teacher\Dashboard::index', ['as' => 'teacher.dashboard']);
    
    $routes->group('courses', function ($routes) {
        $routes->get('/', 'Teacher\Courses::index', ['as' => 'teacher.courses']);
        $routes->get('view/(:num)', 'Teacher\Courses::view/$1', ['as' => 'teacher.courses.view']);
    });
    
    $routes->group('assignments', function ($routes) {
        $routes->get('/', 'Teacher\Assignments::index', ['as' => 'teacher.assignments']);
        $routes->get('create', 'Teacher\Assignments::create', ['as' => 'teacher.assignments.create']);
        $routes->post('store', 'Teacher\Assignments::store', ['as' => 'teacher.assignments.store']);
        $routes->get('grade/(:num)', 'Teacher\Assignments::grade/$1', ['as' => 'teacher.assignments.grade']);
        $routes->post('submit-grade/(:num)', 'Teacher\Assignments::submitGrade/$1', ['as' => 'teacher.assignments.submit-grade']);
    });
    
    $routes->get('gradebook', 'Teacher\Gradebook::index', ['as' => 'teacher.gradebook']);
});

// Student Routes
$routes->group('student', ['filter' => ['auth', 'role:student']], function ($routes) {
    $routes->get('dashboard', 'Student\Dashboard::index', ['as' => 'student.dashboard']);
    
    $routes->group('courses', function ($routes) {
        $routes->get('/', 'Student\Courses::index', ['as' => 'student.courses']);
        $routes->get('enroll', 'Student\Courses::enroll', ['as' => 'student.courses.enroll']);
        $routes->post('enroll', 'Student\Courses::processEnroll', ['as' => 'student.courses.process-enroll']);
        $routes->get('view/(:num)', 'Student\Courses::view/$1', ['as' => 'student.courses.view']);
    });
    
    $routes->group('assignments', function ($routes) {
        $routes->get('/', 'Student\Assignments::index', ['as' => 'student.assignments']);
        $routes->get('view/(:num)', 'Student\Assignments::view/$1', ['as' => 'student.assignments.view']);
        $routes->post('submit/(:num)', 'Student\Assignments::submit/$1', ['as' => 'student.assignments.submit']);
    });
    
    $routes->get('grades', 'Student\Grades::index', ['as' => 'student.grades']);
});

// Profile Routes (all authenticated users)
$routes->group('profile', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Profile::index', ['as' => 'profile']);
    $routes->post('update', 'Profile::update', ['as' => 'profile.update']);
    $routes->post('change-password', 'Profile::changePassword', ['as' => 'profile.change-password']);
});

// API Routes
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->group('v1', function ($routes) {
        $routes->get('courses', 'CourseController::index');
        $routes->get('courses/(:num)', 'CourseController::show/$1');
        
        $routes->group('', ['filter' => 'api-auth'], function ($routes) {
            $routes->post('enroll', 'EnrollmentController::enroll');
            $routes->post('unenroll', 'EnrollmentController::unenroll');
            $routes->post('assignments/submit', 'AssignmentController::submit');
            $routes->get('assignments/(:num)/submissions', 'AssignmentController::submissions');
        });
    });
});

// Maintenance
$routes->get('maintenance', 'Maintenance::index', ['as' => 'maintenance']);
=======
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
>>>>>>> 9bc49831b38c627ac5b7e400f2b51d63a4e97daf
