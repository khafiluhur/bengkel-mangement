<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
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

$routes->get('/', 'Login::index');
$routes->post('/register/process', 'Register::processRegister');
$routes->post('/login/process', 'Register::processLogin');
$routes->get('/logout', 'Register::logout');
$routes->get('/home', 'Home::home');

// Management User //
$routes->group('management_user', function($routes) {
    $routes->get('/', 'Management::user');
    $routes->post('process', 'Management::createUser');
    $routes->post('(:segment)/update', 'Management::updateUser/$1');
    $routes->get('(:segment)/delete', 'Management::deleteUser/$1');
});

// Items //
$routes->group('items', function($routes) {
    $routes->get('/', 'Master::item');
    $routes->post('process', 'Master::createItem');
    $routes->post('(:segment)/update', 'Master::updateItem/$1');
    $routes->get('(:segment)/delete', 'Master::deleteItem/$1');
});

// Montirs //
$routes->group('montirs', function($routes) {
    $routes->get('/', 'Master::montir');
    $routes->post('process', 'Master::createMontir');
    $routes->post('(:segment)/update', 'Master::updateMontir/$1');
    $routes->get('(:segment)/delete', 'Master::deleteMontir/$1');
});

// Customers //
$routes->group('customers', function($routes) {
    $routes->get('/', 'Master::customer');
    $routes->post('process', 'Master::createCustomer');
    $routes->post('(:segment)/update', 'Master::updateCustomer/$1');
    $routes->get('(:segment)/delete', 'Master::deleteCustomer/$1');
});

// Type Items //
$routes->group('type_items', function($routes) {
    $routes->get('/', 'Master::typeItem');
    $routes->post('process', 'Master::createTypeItem');
    $routes->post('(:segment)/update', 'Master::updateTypeItem/$1');
    $routes->get('(:segment)/delete', 'Master::deleteTypeItem/$1');
});

// Merk Items //
$routes->group('merk_items', function($routes) {
    $routes->get('/', 'Master::merkItem');
    $routes->post('process', 'Master::createMerkItem');
    $routes->post('(:segment)/update', 'Master::updateMerkItem/$1');
    $routes->get('(:segment)/delete', 'Master::deleteMerkItem/$1');
});

// Supplier //
$routes->group('suppliers', function($routes) {
    $routes->get('/', 'Master::supplier');
    $routes->post('process', 'Master::createSupplier');
    $routes->post('(:segment)/update', 'Master::updateSupplier/$1');
    $routes->get('(:segment)/delete', 'Master::deleteSupplier/$1');
});

// Check In //
$routes->group('check_in', function($routes) {
    $routes->get('/', 'Transaction::checkIn');
    $routes->post('(:segment)/update', 'Transaction::updateCheckIn/$1');
    $routes->post('(:segment)/detail-update', 'Transaction::updateDetailCheckIn/$1');
    $routes->get('(:segment)/delete-supplier', 'Transaction::deleteCheckIn/$1');
    $routes->get('store', 'Transaction::storeCheckIn');
    $routes->get('(:segment)/detail', 'Transaction::detailCheckIn/$1');
    $routes->post('process-supplier', 'Transaction::createCheckIn');
    $routes->post('process', 'Transaction::createCheckInItem');
    $routes->get('(:segment)/delete', 'Transaction::deleteCheckInItem/$1');
});

// Check Out //
$routes->group('check_out', function($routes) {
    $routes->get('/', 'Transaction::checkOut');
    $routes->post('process', 'Transaction::createCheckOut');
    $routes->post('(:segment)/update', 'Transaction::updateCheckOut/$1');
    $routes->get('(:segment)/delete', 'Transaction::deleteCheckOut/$1');
});

// Check Suppliers //
$routes->group('check_suppliers', function($routes) {
    $routes->get('/', 'TransactionSupplier::checkSupplier');
    $routes->get('store', 'TransactionSupplier::storeCheckSupplier');
    $routes->get('(:segment)/detail', 'TransactionSupplier::detailCheckSupplier/$1');
    $routes->post('process-supplier', 'TransactionSupplier::storeSupplier');
    $routes->post('process', 'TransactionSupplier::storeSupplierItem');
    $routes->post('(:segment)/update', 'TransactionSupplier::updateSupplierItem/$1');
    $routes->post('(:segment)/detail-update', 'TransactionSupplier::updateDetailSupplierItem/$1');
    $routes->get('(:segment)/delete', 'TransactionSupplier::deleteCheckItemSupplier/$1');
    $routes->get('(:segment)/delete-supplier', 'TransactionSupplier::deleteCheckSupplier/$1');
    $routes->get('(:segment)/cetak', 'TransactionSupplier::cetakTransaction/$1');
});

// Report //
$routes->group('report', function($routes) {
    $routes->get('/historycustomer/(:any)', 'Report::historyCustomer/$1');
    $routes->get('/cetakhc', 'Report::cetakhc');
    $routes->get('/listitem/(:any)', 'Report::listItem/$1');
    $routes->get('/cetakli', 'Report::cetakli');
    $routes->get('/cardstock/(:any)', 'Report::cardStock/$1');
    $routes->get('/cetakcs', 'Report::cetakcs');
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
