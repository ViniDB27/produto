<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->group(['prefix' => "api"], function () use ($router){

    $router->group(['prefix'=>'auth'],function () use ($router){
        $router->post('login','AuthController@login');
    });

    $router->group(['prefix' => 'user'], function () use($router) {

        $router->post('/', 'UserController@store');

    });

    $router->group(['prefix' => 'category', 'middleware' => 'auth'], function () use($router) {

        $router->get('/', 'ProductsCategoryController@index');
        $router->post('/', 'ProductsCategoryController@store');
        $router->get('/{id}', 'ProductsCategoryController@show');
        $router->put('/{id}', 'ProductsCategoryController@update');
        $router->delete('/{id}', 'ProductsCategoryController@destroy');

    });

    $router->group(['prefix' => 'product', 'middleware' => 'auth'], function () use($router) {

        $router->get('/', 'ProductController@index');
        $router->post('/', 'ProductController@store');
        $router->get('/{id}', 'ProductController@show');
        $router->put('/{id}', 'ProductController@update');
        $router->delete('/{id}', 'ProductController@destroy');

    });


});
