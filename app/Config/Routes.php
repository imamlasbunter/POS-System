<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/login', 'Login::index');
$routes->post('/login/logincheck', 'Login::LoginCheck');
$routes->get('/logout', 'Login::Logout');


//dashboard
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('/home', 'Dashboard::index', ['filter' => 'auth']);

$routes->group('suppliers', ['filter' => 'auth'], function ($routes) {
	//suppliers
	$routes->get('/', 'Suppliers::index');
	$routes->get('add', 'Suppliers::add');
	$routes->post('add', 'Suppliers::save');
	$routes->delete('delete/(:num)', 'Suppliers::delete/$1');
	$routes->get('edit/(:num)', 'Suppliers::edit/$1');
	$routes->post('edit/(:num)', 'Suppliers::update/$1');
});

$routes->group('customers', ['filter' => 'auth'], function ($routes) {
	//customers
	$routes->get('/', 'Customers::index');
	$routes->get('add', 'Customers::add');
	$routes->post('add', 'Customers::save');
	$routes->delete('delete/(:num)', 'Customers::delete/$1');
	$routes->get('edit/(:num)', 'Customers::edit/$1');
	$routes->post('edit/(:num)', 'Customers::update/$1');
});

$routes->group('category', ['filter' => 'auth'], function ($routes) {
	//category
	$routes->get('/', 'Category::index');
	$routes->get('add', 'Category::add');
	$routes->post('add', 'Category::save');
	$routes->delete('delete/(:num)', 'Category::delete/$1');
	$routes->get('edit/(:num)', 'Category::edit/$1');
	$routes->post('edit/(:num)', 'Category::update/$1');
});

$routes->group('units', ['filter' => 'auth'], function ($routes) {
	//category
	$routes->get('/', 'Units::index');
	$routes->get('add', 'Units::add');
	$routes->post('add', 'Units::save');
	$routes->delete('delete/(:num)', 'Units::delete/$1');
	$routes->get('edit/(:num)', 'Units::edit/$1');
	$routes->post('edit/(:num)', 'Units::update/$1');
});

$routes->group('items', ['filter' => 'auth'], function ($routes) {
	//category
	$routes->get('/', 'Items::index');
	$routes->get('add', 'Items::add');
	$routes->post('add', 'Items::save');
	$routes->delete('delete/(:num)', 'Items::delete/$1');
	$routes->get('edit/(:num)', 'Items::edit/$1');
	$routes->post('edit/(:num)', 'Items::update/$1');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
