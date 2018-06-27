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
$router->group(['middleware' => 'ApiSign'],function () use ($router){
    $router->group(['middleware' => 'AuthUser'] ,function () use ($router){
        $router->get('trans','TransController@recive');
        $router->get('counter','UserController@getcounter');
    });
    $router->get('login','UserController@login');
});


