<?php

namespace Config;

use CodeIgniter\Routing\RouteCollection;
use Config\Services;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::getIndex');
$routes->get('cars', 'Cars::getIndex');

// Auth
$routes->get('login', 'Auth::getLogin');
$routes->post('login', 'Auth::postLogin');
$routes->get('register', 'Auth::getRegister');
$routes->post('register', 'Auth::postRegister');
$routes->get('logout', 'Auth::getLogout');

// Admin
$routes->get('admin', 'Admin\Dashboard::getIndex');

$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], static function ($routes) {
    // Dashboard
    $routes->get('dashboard', 'Dashboard::getIndex');

    // USERS
    $routes->get('users', 'Users::getIndex');
    $routes->get('users/new', 'Users::getNew');
    $routes->post('users/create', 'Users::postCreate');
    $routes->get('users/edit/(:num)', 'Users::getEdit/$1');
    $routes->post('users/update/(:num)', 'Users::postUpdate/$1');
    $routes->post('users/delete/(:num)', 'Users::postDelete/$1');

    // 🚗 CARS
    $routes->get('cars', 'Cars::getIndex');                     // liste
    $routes->get('cars/new', 'Cars::getNew');                   // formulaire création
    $routes->post('cars/create', 'Cars::postCreate');           // POST création

    $routes->get('cars/edit/(:num)', 'Cars::getEdit/$1');       // formulaire édition
    $routes->post('cars/update/(:num)', 'Cars::postUpdate/$1'); // POST update

    $routes->post('cars/delete/(:num)', 'Cars::postDelete/$1'); // POST delete
});
