<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


$router->get('/', 'HomeController@index');
$router->get('/mr-lists', 'HomeController@mrLists');
$router->get('/services', 'HomeController@services');
$router->get('/download', 'HomeController@download');
$router->get('/about', 'HomeController@about');
$router->get('/contact', 'HomeController@contact');

$router->group(['middleware' => 'guest'],function() use ($router){
    $router->get('/login', 'AuthController@showLogin');
    $router->post('/login', 'AuthController@login');
    $router->get('/register', 'AuthController@showRegister');
    $router->post('/register', 'AuthController@register');
});

$router->group(['middleware' => 'auth'],function() use ($router){
    $router->get('/logout', 'AuthController@logout');
    $router->get('/dashboard', 'DashboardController@index');
    $router->get('/mr-verify/{experience_id}/{mobile_no}', 'DashboardController@mrVerify');
    $router->get('/my-mr', 'DashboardController@myMrList');
    $router->get('/mr-doctor/{mr_mobile_no}/{api_token}', 'DashboardController@mrDoctorList');
    $router->get('/mr-assistant/{mr_mobile_no}/{api_token}', 'DashboardController@mrAssistantList');
    $router->get('/mr-doctor-visit-history/{mr_mobile_no}/{doctor_mobile_no}/{api_token}', 'DashboardController@mrDoctorVisitHistory');
    $router->get('/mr-doctor-visit-history-search', 'DashboardController@mrDoctorVisitHistorySearch');
    $router->get('/mr-coupons-details/{mr_mobile_no}/{api_token}', 'DashboardController@mrCouponsDetails');
});
