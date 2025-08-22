<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Set default namespace, controller, and method
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');

// Define routes
$routes->get('/', 'Home::index');               // Homepage
$routes->get('/about', 'Home::about');          // About Page
$routes->get('/contact', 'Home::contact');      // Contact Page
$routes->get('/bootstrap', 'Bootstrap::index'); // Bootstrap page (optional)
