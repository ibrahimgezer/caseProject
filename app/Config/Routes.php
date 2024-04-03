<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setAutoRoute(true);

//Dashboard
$routes->get('/', 'HomeController::index');

//Auth
$routes->get('login', 'AuthController::loginPage');
$routes->post('login_process', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

//Users
$routes->get('users', 'UserController::index');
$routes->get('user_add', 'UserController::user_add_page');
$routes->get('user_edit/(:any)', 'UserController::user_edit_page/$1');
$routes->post('create_user', 'UserController::user_create');
$routes->post('update_user/(:any)', 'UserController::user_update/$1');
$routes->post('delete_user/(:any)', 'UserController::user_delete/$1');

//Categories
$routes->get('categories', 'CategoryController::index');
$routes->get('category_add', 'CategoryController::category_add_page');
$routes->get('category_edit/(:any)', 'CategoryController::category_edit_page/$1');
$routes->post('create_category', 'CategoryController::category_create');
$routes->post('update_category/(:any)', 'CategoryController::category_update/$1');
$routes->post('delete_category/(:any)', 'CategoryController::category_delete/$1');

//Brands
$routes->get('brands', 'BrandController::index');
$routes->get('brand_add', 'BrandController::brand_add_page');
$routes->get('brand_edit/(:any)', 'BrandController::brand_edit_page/$1');
$routes->post('create_brand', 'BrandController::brand_create');
$routes->post('update_brand/(:any)', 'BrandController::brand_update/$1');
$routes->post('delete_brand/(:any)', 'BrandController::brand_delete/$1');