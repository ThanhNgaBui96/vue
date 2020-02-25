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

Route::group(['middleware' => 'api'], function ($router) {
    Route::post('login', 'Auth\LoginController@login')->name('login');
    Route::post('user', 'Auth\LoginController@getAuthenticatedUser');
    Route::post('logout', 'Auth\LoginController@logout');
});

Route::get('/getUser', 'UserController@getUser');

