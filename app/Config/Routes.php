<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\{HomeController, ExaminationController};

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');
$routes->post('/search_examinations', 'ExaminationController::search');
//~ $routes->get('(:segment)', [Pages::class, 'view']);*/
