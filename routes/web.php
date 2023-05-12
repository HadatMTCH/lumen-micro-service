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

$router->group(['prefix' => 'countries'], function () use ($router) {
    $router->get('/', [
        'as' => 'countries', 'uses' => 'ExampleController@index'
    ]);

    $router->get('/{id}', [
        'as' => 'getCountriesById', 'uses' => 'ExampleController@getCountryById'
    ]);

    $router->post('/create', [
        'as' => 'createCountry', 'uses' => 'ExampleController@createCountry'
    ]);

    $router->put('/{id}/update', [
        'as' => 'updateCountry', 'uses' => 'ExampleController@updateCountry'
    ]);

    $router->delete('/{id}/delete', [
        'as' => 'deleteCountry', 'uses' => 'ExampleController@deleteCountry'
    ]);
});


$router->group(['prefix' => 'cities'], function () use ($router) {
    $router->get('/', [
        'as' => 'cities', 'uses' => 'ExampleController@getAllCities'
    ]);

    $router->get('/{id}', [
        'as' => 'getCityById', 'uses' => 'ExampleController@getCityById'
    ]);

    $router->post('/create', [
        'as' => 'createCity', 'uses' => 'ExampleController@createCity'
    ]);

    $router->put('/{id}/update', [
        'as' => 'updateCity', 'uses' => 'ExampleController@updateCity'
    ]);

    $router->delete('/{id}/delete', [
        'as' => 'deleteCity', 'uses' => 'ExampleController@deleteCity'
    ]);
});
