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
    $api->get('/logout', 'AuthController@logout');
  });

});
