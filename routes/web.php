<?php
$router->post('/dang-xuat', '\App\Controllers\Auth\LoginController@logout');
$router->get('/dang-nhap', '\App\Controllers\Auth\LoginController@showLoginForm');
$router->post('/dang-nhap', '\App\Controllers\Auth\LoginController@login');

// Admin routes

$router->post('/quan-ly/sua-the-loai/([a-zA-Z0-9-]*)', '\App\Controllers\DashboardController@handle_update_category');
$router->get('/quan-ly/sua-the-loai/([a-zA-Z0-9-]*)', '\App\Controllers\DashboardController@update_category');
$router->post('/quan-ly/them-the-loai', '\App\Controllers\DashboardController@handle_add_category');
$router->get('/quan-ly/them-the-loai', '\App\Controllers\DashboardController@add_category');
$router->get('/quan-ly/quan-ly-the-loai', '\App\Controllers\DashboardController@category_management');

$router->get('/quan-ly/xoa-chapter/([a-zA-Z0-9-]*)', '\App\Controllers\DashboardController@handle_delete_chapter');
$router->post('/quan-ly/chinh-sua-chapter/([a-zA-Z0-9-]*)', '\App\Controllers\DashboardController@handle_update_chapter');
$router->get('/quan-ly/chinh-sua-chapter/([a-zA-Z0-9-]*)', '\App\Controllers\DashboardController@update_chapter');
$router->post('/quan-ly/them-chapter/([a-zA-Z0-9-]*)', '\App\Controllers\DashboardController@handle_add_chapter');
$router->get('/quan-ly/them-chapter/([a-zA-Z0-9-]*)', '\App\Controllers\DashboardController@add_chapter');
$router->get('/quan-ly/danh-sach-chapter/([a-zA-Z0-9-]*)', '\App\Controllers\DashboardController@chapter');

$router->get('/quan-ly/xoa-truyen/([a-zA-Z0-9-]*)', '\App\Controllers\DashboardController@handle_delete_story');
$router->post('/quan-ly/chinh-sua-truyen/([a-zA-Z0-9-]*)', '\App\Controllers\DashboardController@handle_update_story');
$router->get('/quan-ly/chinh-sua-truyen/([a-zA-Z0-9-]*)', '\App\Controllers\DashboardController@update_story');
$router->post('/quan-ly/them-truyen', '\App\Controllers\DashboardController@handle_add_story');
$router->get('/quan-ly/them-truyen', '\App\Controllers\DashboardController@add_story');
$router->get('/quan-ly/quan-ly-truyen', '\App\Controllers\DashboardController@index');
$router->get('/quan-ly', '\App\Controllers\DashboardController@index');
// User routes

$router->get('/doc-truyen/([a-zA-Z0-9-]*)', '\App\Controllers\HomeController@read');
$router->get('/thong-tin-truyen/([a-zA-Z0-9-]*)', '\App\Controllers\HomeController@detail');

// search
$router->post('/', '\App\Controllers\HomeController@search');
// Home
$router->get('/trang-chu/([a-zA-Z0-9-]*)', '\App\Controllers\HomeController@index');
$router->get('/([a-zA-Z0-9-]*)', '\App\Controllers\HomeController@index');
$router->get('/trang-chu', '\App\Controllers\HomeController@index');
$router->get('/', '\App\Controllers\HomeController@index');

$router->run();