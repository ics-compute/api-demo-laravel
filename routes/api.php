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
Route::get('/login', function () {
    $res = [
        'code' => 403,
        'message' => 'Unauthorised'
    ];
    return response()->json($res, 403);
})->name('login');
Route::post('login', 'API\UserController@login')->name('login');
Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('details', 'API\UserController@details');
    Route::get('details/{id}', 'API\UserController@details');
    Route::patch('user/{id}', 'API\UserController@update');
    Route::delete('user/{id}', 'API\UserController@remove');
    Route::get('list', 'API\UserController@list');
});
Route::fallback(function(){
    $res = [
        'code' => 404,
        'message' => 'Page Not Found'
    ];
    return response()->json($res, 404);
});
