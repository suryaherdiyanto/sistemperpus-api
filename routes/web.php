<?php
$api = app('Dingo\Api\Routing\Router');
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

$api->version('v1', function() use($api) {

  $api->group(['namespace' => 'App\Http\Controllers'], function() use($api) {
    $api->post('/login', 'AuthController@login');
    $api->post('/logout', 'AuthController@logout');

    $api->group(['middleware' => 'jwt.auth'], function () use($api) {
        $api->get('/members', 'MemberController@index');
        $api->post('/members', 'MemberController@store');
        $api->put('/members/{id}/update', 'MemberController@update');
        $api->delete('/members/{id}', 'MemberController@delete');
    });

    $api->get('/publishers', 'PublisherController@index');
    $api->post('/publishers', 'PublisherController@store');
    $api->put('/publishers/{id}/update', 'PublisherController@update');
    $api->delete('/publishers/{id}', 'PublisherController@delete');

    $api->get('/categories', 'CategoryController@index');
    $api->post('/categories', 'CategoryController@store');
    $api->put('/categories/{id}/update', 'CategoryController@update');
    $api->delete('/categories/{id}', 'CategoryController@delete');
  });

});
