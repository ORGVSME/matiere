<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::login');
$routes->post('/home/authenticate', 'Home::authenticate');
$routes->get('/dashboard', 'Home::dashboard');
$routes->get('/logout', 'Home::logout');

// Routes pour la gestion des utilisateurs
$routes->get('/utilisateurs', 'Users::index');
$routes->get('/utilisateurs/create', 'Users::create');
$routes->post('/utilisateurs/store', 'Users::store');
$routes->get('/utilisateurs/view/(:num)', 'Users::view/$1');
$routes->get('/utilisateurs/edit/(:num)', 'Users::edit/$1');
$routes->post('/utilisateurs/update/(:num)', 'Users::update/$1');
$routes->get('/utilisateurs/delete/(:num)', 'Users::delete/$1');
$routes->get('/utilisateurs/export', 'Users::export');
