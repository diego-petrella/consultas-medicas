<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');


$routes->options('(:any)', static function () {
    return service('response')->setStatusCode(204);
});

//Rutas para user

$routes->post('login', 'User\UserPostController::login');