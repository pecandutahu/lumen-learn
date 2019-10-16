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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/todolists','TodolistController@index');
$router->get('/todolists/{id}','TodolistController@detail');
$router->post('/todolists/store','TodolistController@store');
$router->post('/todolists/update','TodolistController@update');
$router->post('/todolists/changestatus','TodolistController@changestatus');
$router->post('/todolists/destroy','TodolistController@destroy');
$router->post('/user/register','UserController@register');
$router->get('/user','UserController@index');
$router->get('/user/{id}','UserController@detail');
$router->post('/user/login','UserController@login');