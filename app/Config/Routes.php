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
    $routes->get('dashboard', 'Dashboard::getIndex');

    // USERS
    $routes->get('users/', 'Users::getIndex');                  // liste
    $routes->get('users/new', 'Users::getNew');                // formulaire création
    $routes->post('users/create', 'Users::postCreate');        // POST création
    $routes->get('users/edit/(:num)', 'Users::getEdit/$1');    // formulaire édition
    $routes->post('users/update/(:num)', 'Users::postUpdate/$1'); // POST update
    $routes->post('users/delete/(:num)', 'Users::postDelete/$1'); // POST delete


    // CARS
    $routes->get('cars', 'Cars::getIndex');
    $routes->get('cars/new', 'Cars::getNew');
    $routes->post('cars/create', 'Cars::postCreate');
    $routes->get('cars/edit/(:num)', 'Cars::getEdit/$1');
    $routes->post('cars/update/(:num)', 'Cars::postUpdate/$1');
    $routes->post('cars/delete/(:num)', 'Cars::postDelete/$1');
});
