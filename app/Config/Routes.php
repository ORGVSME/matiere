<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::login');
$routes->post('/home/authenticate', 'Home::authenticate');
$routes->get('/dashboard', 'Home::dashboard');
$routes->get('/logout', 'Home::logout');
