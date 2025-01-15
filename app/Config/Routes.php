<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Barang::index');
$routes->get('barang', 'Barang::index');
$routes->get('barang/create', 'Barang::create');
$routes->post('barang/create', 'Barang::store');
$routes->get('barang/view/(:num)', 'Barang::view/$1');
$routes->get('barang/edit/(:num)', 'Barang::edit/$1');
$routes->post('barang/edit/(:num)', 'Barang::update/$1');
$routes->get('barang/delete/(:num)', 'Barang::delete/$1');
$routes->get('barang/search', 'Barang::search');
$routes->get('barang/exportCsv', 'Barang::exportCsv');
