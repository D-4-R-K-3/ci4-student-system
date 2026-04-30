<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route
$routes->get('/', 'Students::index');
$routes->get('students', 'Students::index');
$routes->get('students/create', 'Students::create');
$routes->post('students/store', 'Students::store');
$routes->get('students/edit/(:num)', 'Students::edit/$1');
$routes->post('students/update/(:num)', 'Students::update/$1');
$routes->get('students/delete/(:num)', 'Students::delete/$1');
