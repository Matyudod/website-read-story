<?php
$router->post('/dang-xuat', '\App\Controllers\Auth\LoginController@logout');
$router->get('/dang-nhap', '\App\Controllers\Auth\LoginController@showLoginForm');
$router->post('/dang-nhap', '\App\Controllers\Auth\LoginController@login');

// Admin routes

$router->post('/quan-ly/them-truyen', '\App\Controllers\DashboardController@handle_add_story');
$router->get('/quan-ly/them-truyen', '\App\Controllers\DashboardController@add_story');
$router->get('/quan-ly/quan-ly-truyen', '\App\Controllers\DashboardController@index');
$router->get('/quan-ly', '\App\Controllers\DashboardController@index');
// User routes

$router->get('/doc-truyen/([a-zA-Z0-9-]*)', '\App\Controllers\HomeController@read');
$router->get('/thong-tin-truyen/([a-zA-Z0-9-]*)', '\App\Controllers\HomeController@detail');
$router->get('/trang-chu/([a-zA-Z0-9-]*)', '\App\Controllers\HomeController@index');
$router->get('/([a-zA-Z0-9-]*)', '\App\Controllers\HomeController@index');
$router->get('/trang-chu', '\App\Controllers\HomeController@index');
$router->get('/', '\App\Controllers\HomeController@index');

$router->run();