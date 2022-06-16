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
$routes->setDefaultController('MainController');
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

#Main Routers
$routes->get('/', 'GoodsAccessor::mainView');

#Header's Routers

#Footer's Routers

#Goods Routers - Customer
$routes->get('goods', 'GoodsAccessor::mainView');
$routes->get('company/(:num)', 'GoodsAccessor::companyView/$1');
$routes->get('equipment/(:num)', 'GoodsAccessor::equipmentView/$1');

#Services Routers - Customer
$routes->get('services', 'GoodsAccessor::services');

#Promos Routers - Customer
$routes->get('promos', 'GoodsAccessor::promos');

#Jobs Routers - Customer
$routes->get('jobs', 'GoodsAccessor::jobs');

#Main Routers - Supplier
$routes->get('login', 'BackEndAssessor::loginView');
    $routes->post('login-request', 'BackEndAssessor::loginRequest');

$routes->get('supplier', 'BackEndAssessor::supplierView');

#Supplier Plateforms Routers - Sections
    #Brand Manager Routers
    $routes->get('brand-manager', 'BackEndAssessor::brandManager');
        $routes->get('company-brands','BackEndAssessor::companyBrand');
            $routes->get('add-new-brand', 'BackEndAssessor::newBrand');        
                $routes->post('brand-creation', 'BackEndAssessor::createBrand');
                $routes->get('more-abt-brand/(:num)', 'BackEndAssessor::moreBrandDetails/$1');

            $routes->get('modify-brand/(:num)', 'BackEndAssessor::modifyBrand/$1');
                $routes->post('brand-editing', 'BackEndAssessor::editBrand');
            $routes->get('change-brand/(:num)', 'BackEndAssessor::changeBrand/$1');

        $routes->get('map-brand', 'BackEndAssessor::brandManager');
        $routes->get('expire-brand/(:num)', 'BackEndAssessor::expireBrand/$1');
    
    #Product Store Routers
    $routes->get('product-store', 'BackEndAssessor::productStorage');

    #Offer Manager Routers
    $routes->get('offer-manager', 'BackEndAssessor::offerManager');

    #Serice Plateform Routers
    $routes->get('service-plateform', 'BackEndAssessor::servicePlateform');
    
    #Job Hub Routers
    $routes->get('job-hub', 'BackEndAssessor::jobHub');
    
    #Approval Hub Routers
    $routes->get('approval-hub', 'BackEndAssessor::approvalHub');
    
    #Report Center Routers
    $routes->get('reports-center', 'BackEndAssessor::reportsCenter');

$routes->get('KDM', 'BackEndAssessor::kingdom360');


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
