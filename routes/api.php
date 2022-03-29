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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'App\Http\Controllers\LoginController@register');
Route::post('/login', 'App\Http\Controllers\LoginController@login');


Route::group(['prefix' => '/account'], function (){
    Route::get('/list', 'App\Http\Controllers\Account\AccountController@getAll');
    Route::post('/add', 'App\Http\Controllers\Account\AccountController@create');
    Route::get('/find', 'App\Http\Controllers\Account\AccountController@find');
});

Route::group(['prefix' => '/location'], function (){
    Route::get('/city', 'App\Http\Controllers\LocationController@getCity');
    Route::get('/district', 'App\Http\Controllers\LocationController@getDistrict');
    Route::get('/ward', 'App\Http\Controllers\LocationController@getWard');
});
