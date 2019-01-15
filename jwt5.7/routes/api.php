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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
//// 授权与登录
//Route::group([
//
//    'middleware' =>['api'],
//    'prefix' => 'auth'
//
//], function ($router) {
//
//    Route::post('login', 'AuthController@login');
//    Route::post('logout', 'AuthController@logout');
//    Route::post('refresh', 'AuthController@refresh');
//    Route::post('me', 'AuthController@me');
//
//});
//
//Route::middleware('refresh.token')->group(function($router) {
//    // $router->get('profile','UserController@profile');
//
//});
//Route::get('/inner', 'AuthController@inner')->middleware('refresh.token');

Route::prefix('auth')->group(function($router) {
    $router->post('login', 'AuthController@login');
    $router->post('logout', 'AuthController@logout');

});

Route::middleware('refresh.token')->group(function($router) {
    $router->get('profile','UserController@profile');
});