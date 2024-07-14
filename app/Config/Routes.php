<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// $routes->get('crud', 'Crud::index');
// $routes->post('crud/agregar', 'Crud::agregar');
// $routes->get('crud/editar/', 'Crud::editar');
// $routes->post('crud/editar/', 'Crud::editar');

$routes->resource('crud', ['placeholder' => '(:num)', 'except' => 'show']);
