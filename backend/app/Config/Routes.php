<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('obras-sociales', 'ObraSocial\ObraSocialesGetController::search');
$routes->get('obras-sociales/(:num)', 'ObraSocial\ObraSocialGetController::find/$1');
$routes->post('obras-sociales', 'ObraSocial\ObraSocialPostController::create');
$routes->put('obras-sociales/(:num)', 'ObraSocial\ObraSocialPutController::put/$1');
$routes->delete('obras-sociales/(:num)', 'ObraSocial\ObraSocialDeleteController::do/$1');

//Rutas para user
$routes->post('login', 'User\UserPostController::login');
$routes->post('logout', 'User\UserLogoutController::logout');
