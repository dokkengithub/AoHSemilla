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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::get('/', function () {
    return "Hola";
});

Route::group([
    'prefix' => 'aoh/auth'
], function () {
    //Route::post('login',  \App\Http\Controllers\Auth\AuthController::class, 'login');
    Route::apiResource('register', \App\Http\Controllers\Auth\RegisterController::class);

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        //Route::get('logout', \App\Http\Controllers\Auth\AuthController::class, 'logout');
        //Route::get('user', \App\Http\Controllers\Auth\LoginController::class, 'user');
    });
});

Route::group([
    'prefix' => 'aoh'
], function () {
    Route::apiResource("oportunidadh", \App\Http\Controllers\OportunidadHController::class);

    Route::group([
      'middleware' => 'auth:api'
    ], function() {

    });
});

//Route::get("login", [ \App\Http\Controllers\UserController::class, 'login' ]);

