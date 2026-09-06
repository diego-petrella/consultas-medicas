<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->options('(:any)', static function () {
    return service('response')->setStatusCode(204);
});

//'activas' va antes que la ruta general para no chocar con futuros filtros por (:num)
$routes->get('obras-sociales/activas', 'ObraSocial\ObraSocialActivasController::activas');
$routes->get('obras-sociales', 'ObraSocial\ObraSocialesGetController::search');
$routes->get('obras-sociales/(:num)', 'ObraSocial\ObraSocialGetController::find/$1');
$routes->post('obras-sociales', 'ObraSocial\ObraSocialPostController::create');
$routes->put('obras-sociales/(:num)', 'ObraSocial\ObraSocialPutController::put/$1');
$routes->delete('obras-sociales/(:num)', 'ObraSocial\ObraSocialDeleteController::do/$1');

//Rutas para user
$routes->post('login', 'User\UserPostController::login');
$routes->post('logout', 'User\UserLogoutController::logout');

//Rutas para usuarios (protegidas: sin sesion -> 401, y solo Administrativo puede crear/editar/borrar)
$routes->get('users', 'User\UserGetController::find', ['filter' => 'auth']);
$routes->post('users', 'User\UserPostController::create', ['filter' => 'auth:1']);
$routes->put('users/(:num)', 'User\UserPutController::put/$1', ['filter' => 'auth:1']);
$routes->delete('users/(:num)', 'User\UserDeleteController::do/$1', ['filter' => 'auth:1']);

//Rutas para historias clinicas
$routes->post('historias-clinicas', 'HistoriaClinica\HistoriaClinicaPostController::create');
$routes->get('historias-clinicas/(:num)/pdf', 'HistoriaClinica\HistoriaClinicaPdfController::pdf/$1');

//Rutas para roles (solo lectura -- son constantes del sistema, no se crean/editan por API)
$routes->get('roles', 'Role\RolesGetController::search');
$routes->get('roles/(:num)', 'Role\RoleGetController::find/$1');

//Rutas para pacientes
//'buscar' va antes de las rutas con (:num) para que CodeIgniter no la confunda con un id numerico
$routes->get('pacientes/buscar', 'Paciente\PacienteBuscarController::buscar');
$routes->get('pacientes/(:num)/historial', 'Paciente\PacienteHistorialController::historial/$1');
$routes->post('pacientes', 'Paciente\PacientePostController::create');
$routes->put('pacientes/(:num)', 'Paciente\PacientePutController::put/$1');

//Rutas para visitas
$routes->get('visitas', 'Visita\VisitaGetController::search');
$routes->get('visitas/(:num)', 'Visita\VisitaShowController::show/$1');
$routes->post('visitas', 'Visita\VisitaPostController::create');
$routes->put('visitas/(:num)', 'Visita\VisitaPutController::put/$1');
$routes->delete('visitas/(:num)', 'Visita\VisitaDeleteController::delete/$1');

//Rutas para doctores
//'activos' va antes que la ruta general para no chocar con futuros filtros por (:num)
$routes->get('doctores/activos', 'Doctor\DoctorActivosController::activos');
$routes->get('doctores', 'Doctor\DoctorGetController::index');
$routes->post('doctores', 'Doctor\DoctorPostController::create');
$routes->put('doctores/(:num)', 'Doctor\DoctorPutController::put/$1');
$routes->delete('doctores/(:num)', 'Doctor\DoctorDeleteController::delete/$1');
