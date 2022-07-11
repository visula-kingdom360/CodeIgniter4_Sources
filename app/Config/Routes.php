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

################ Main Routers ################
$routes->get(
    '/',
    'GoodsAccessor::mainView'
);

################ Header's Routers ################

################ Footer's Routers ################

################ Goods Routers - Customer ################
$routes->get(
    'goods',
    'GoodsAccessor::mainView'
);
$routes->get(
    'company/(:num)',
    'GoodsAccessor::companyView/$1'
);
$routes->get(
    'equipment/(:num)',
    'GoodsAccessor::equipmentView/$1'
);

################ Services Routers - Customer ################
$routes->get(
    'services',
    'GoodsAccessor::services'
);

################ Promos Routers - Customer ################
$routes->get(
    'promos',
    'GoodsAccessor::promos'
);

################ Jobs Routers - Customer ################
$routes->get(
    'jobs',
    'GoodsAccessor::jobs'
);

################ Main Routers - Supplier ################
#login screen calling methodology
$routes->get(
    'login',
    'BackEndAssessor::loginView'
);

#login validation process
$routes->post(
    'login-request',
    'BackEndAssessor::loginRequest'
);


################ Supplier Plateforms Routers - Sections ################
$routes->get(
    'supplier-plateform',
    'BackEndAssessor::supplierView'
);

################ Brand Manager Routers - Sub Sections ################
$routes->get(
    'supplier-plateform/brands/owned/brand-details',
    'BackEndAssessor::companyBrand'
);
$routes->get(
    'supplier-plateform/brands/owned/add-new-brand',
    'BackEndAssessor::newBrand'
);
$routes->post(
    'supplier-plateform/brands/owned/brand-creation',
    'BackEndAssessor::createBrand'
);

$routes->get(
    'supplier-plateform/brands/owned/more-abt-brand/(:num)','BackEndAssessor::moreBrandDetails/$1'
);
$routes->get(
    'supplier-plateform/brands/owned/modify-brand/(:num)',
    'BackEndAssessor::modifyBrand/$1'
);
$routes->get(
    'supplier-plateform/brands/owned/expire-brand/(:num)',
    'BackEndAssessor::expireBrand/$1'
);
$routes->post(
    'supplier-plateform/brands/owned/brand-editing',
    'BackEndAssessor::editBrand'
);

$routes->get(
    'supplier-plateform/brands/access/brand-details',
    'BackEndAssessor::brandManager'
);
$routes->get(
    'supplier-plateform/brands/access/map-brand',
    'BackEndAssessor::mapBrandAccess'
);
$routes->post(
    'supplier-plateform/brands/access/js-request/brand-detail',
    'BackEndAssessor::jsBrandDetail'
);
$routes->post(
    'supplier-plateform/brands/access/add-mapped-brand',
    'BackEndAssessor::mapNewAccess'
);
$routes->get(
    'supplier-plateform/brands/access/expire-brand/(:num)',
    'BackEndAssessor::expireBrandAccess/$1'
);

################ Product Store Routers - Sub Sections ################
$routes->get(
    'supplier-plateform/product-store',
    'BackEndAssessor::productStorage'
);
$routes->post(
    'supplier-plateform/product-store/js-request/equipment-search',
    'BackEndAssessor::jsEquipSearch'
);


################ Offer Manager Routers - Sub Sections ################
$routes->get(
    'supplier-plateform/offer-manager',
    'BackEndAssessor::offerManager'
);

################ Serice Plateform Routers - Sub Sections ################
$routes->get(
    'supplier-plateform/service-plateform',
    'BackEndAssessor::servicePlateform'
);

################ Job Hub Routers - Sub Sections ################
$routes->get(
    'supplier-plateform/job-hub',
    'BackEndAssessor::jobHub'
);

################ Approval Hub Routers - Sub Sections ################
$routes->get(
    'supplier-plateform/approval-hub',
    'BackEndAssessor::approvalHub'
);

################ Report Center Routers - Sub Sections ################
$routes->get(
    'supplier-plateform/reports-center',
    'BackEndAssessor::reportsCenter'
);

$routes->get(
    'KDM',
    'BackEndAssessor::kingdom360'
);

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
