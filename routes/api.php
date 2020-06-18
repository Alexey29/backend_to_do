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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/registration', 'AuthController@registration');
Route::post('/login', 'AuthController@login');
Route::middleware('auth:api')->post('/logout', 'AuthController@logout');

Route::prefix('task')->group(function () {
    Route::middleware('auth:api')->get('getAll', 'TaskController@getAll');
    Route::middleware('auth:api')->get('getOne/{id}', 'TaskController@getOne');
    Route::middleware('auth:api')->delete('delete/{id}', 'TaskController@delete');
    Route::middleware('auth:api')->post('create', 'TaskController@create');
    Route::middleware('auth:api')->put('update/{id}', 'TaskController@update');
});
