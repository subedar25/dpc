<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('UserController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'UserController::index');
$routes->get('jodichart', 'UserController::jodichart');
$routes->get('panelchart', 'UserController::panelchart');
$routes->get('singlepanelchart', 'UserController::singlepanelchart');
$routes->get('matka-jodi-count-chart', 'UserController::matkajodichart');
$routes->get('fix-open-to-close-by-date', 'UserController::fixopentoclosebydate');
$routes->get('jodi-chart-family-matka', 'UserController::jodichartfamilymatka');
$routes->get('penal-count-chart', 'UserController::penalcountchart');
$routes->get('penal-total-chart', 'UserController::penaltotalchart');

//for cron 
$routes->cli('singleresult', 'UserController::generatesingleresult');
$routes->cli('multipleresults', 'UserController::generatemultipleresult');
$routes->cli('backupmultipleresult', 'UserController::backupmultipleresult');
$routes->cli('viewresult', 'UserController::viewresult');
$routes->cli('cron', 'Crons\Cron::index');


$routes->get('cron', 'Crons\Cron::index');

$routes->get('singleresult', 'UserController::generatesingleresult');
$routes->get('multipleresults', 'UserController::generatemultipleresult');
$routes->get('backupmultipleresult', 'UserController::backupmultipleresult');
$routes->get('viewresult', 'UserController::viewresult');
$routes->get('loadmoreresult', 'UserController::loadmoreesult');
$routes->get('generateresult', 'UserController::generateresult');

//admin side
$routes->get('admin', 'Admin::index');
$routes->post('admin', 'Admin::index');
$routes->get('dashboard', 'Admin::dashboard');
$routes->get('logout', 'Admin::logout');
$routes->get('adminprofile', 'AdminProfile::index');
$routes->get('cpassword', 'AdminProfile::cpassword');
$routes->post('updatepassword', 'AdminProfile::UpdatePassword');

$routes->get('company', 'Category::index');
$routes->get('companymul', 'Category::companymul');
$routes->get('createcompany', 'Category::createcompany');
$routes->get('editcategoryform', 'Category::editcategoryform');
$routes->post('updatcompany', 'Category::updatcompany');
$routes->post('addcompany', 'Category::addcompany');
$routes->get('delcategory', 'Category::delcategory');


// single company
$routes->get('todayresult', 'Companyresult::index');
$routes->get('editresultform', 'Companyresult::editresultform');
$routes->post('updatresult', 'Companyresult::updatresult');
$routes->get('delresult', 'Companyresult::delresult');

// multiple company
$routes->get('multipleresult', 'Companymultiple::index');
$routes->get('editmulresultform', 'Companymultiple::editmulresultform');
$routes->post('updatmulresult', 'Companymultiple::updatmulresult');
$routes->get('delmulresult', 'Companymultiple::delmulresult');
$routes->get('mulhistory', 'Companymultiple::mulhistory');
$routes->get('delmulhistoryresult', 'Companymultiple::delmulhistoryresult');

$routes->get('settings', 'Settings::index');
$routes->post('updatesetting', 'Settings::updatesetting');
$routes->post('updatesettingvalues', 'Settings::updatesettingvalues');
$routes->post('removesetting', 'Settings::removesetting');
$routes->post('cyclemotor', 'Cyclemotor::index');
$routes->get('cyclemotor', 'Cyclemotor::index');
$routes->get('parsedata', 'Parsedata::index');
$routes->get('liveresultjson', 'UserController::liveResultJson');

// API: update company result
$routes->post('api/company-result', 'Api\\CompanyResultApi::update');


/***
 *   rest api routing
 */

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have accessgit  to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
