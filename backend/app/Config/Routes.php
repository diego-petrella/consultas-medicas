<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->options('(:any)', static function () {
    return service('response')->setStatusCode(204);
});

$routes->get('obras-sociales', 'ObraSocial\ObraSocialesGetController::search');
$routes->get('obras-sociales/(:num)', 'ObraSocial\ObraSocialGetController::find/$1');
$routes->post('obras-sociales', 'ObraSocial\ObraSocialPostController::create');
$routes->put('obras-sociales/(:num)', 'ObraSocial\ObraSocialPutController::put/$1');
$routes->delete('obras-sociales/(:num)', 'ObraSocial\ObraSocialDeleteController::do/$1');

//Rutas para user
$routes->post('login', 'User\UserPostController::login');
$routes->post('logout', 'User\UserLogoutController::logout');

//Rutas para historias clinicas
$routes->post('historias-clinicas', 'HistoriaClinica\HistoriaClinicaPostController::create');
$routes->get('historias-clinicas/(:num)/pdf', 'HistoriaClinica\HistoriaClinicaPdfController::pdf/$1');

//Rutas para roles (solo lectura -- son constantes del sistema, no se crean/editan por API)
$routes->get('roles', 'Role\RolesGetController::search');
$routes->get('roles/(:num)', 'Role\RoleGetController::find/$1');
