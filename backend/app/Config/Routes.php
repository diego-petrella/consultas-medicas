<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');


//Rutas para user

$routes->post('login', 'User\UserPostController::login');