<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {

    $api->group(['namespace'=>'App\Http\Controllers','middleware'=>'auth:api'],function ($api){

        $api->post('/register','UserController@register');

        $api->post('/register','UserController@register');

        $api->post('/login','UserController@login');

        $api->get('/user','TestController@index');

        $api->get('/profession','ProfessionController@profession');
    });


});

//Route::get('/user','TestController@index');

Route::middleware('auth:api')->get('/test', 'TestController@test');

