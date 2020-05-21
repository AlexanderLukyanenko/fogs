<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('auth')->group(function () {
    Route::post('register', 'Api\V1\AuthController@register');
    Route::post('login', 'Api\V1\AuthController@login');
    Route::get('refresh', 'Api\V1\AuthController@refresh');
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'Api\V1\AuthController@user');
        Route::post('logout', 'Api\V1\AuthController@logout');
    });
});

Route::prefix('users')->group(function () {
    Route::get('{id}', 'Api\V1\UserController@show')->middleware('checkIsSelf');
    Route::put('{id}', 'Api\V1\UserController@update')->middleware('checkIsSelf');
});


Route::prefix('news')->group(function () {
    Route::get('', 'Api\V1\NewsController@index');
});
