<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Response;
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
    return "Bienvenido";
});

Route::get('reset-config', function (){
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('optimize');

    return Response::json(
        [
            'status' => true,
            'message' => "Configuración reseteada.."
        ],
        200
    );
});


Route::group([
    'prefix' => 'aoh/auth'
], function () {
    //Route::post('login',  \App\Http\Controllers\Auth\AuthController::class, 'login');
    //Route::apiResource('register', \App\Http\Controllers\Api\Auth\RegisterController::class);

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

    Route::apiResource("oportunidada", \App\Http\Controllers\Api\OportunidadActividadController::class);

    Route::apiResource("oportunidadan", \App\Http\Controllers\Api\OportunidadAnexoController::class);

    Route::apiResource("oportunidadc", \App\Http\Controllers\Api\OportunidadCompetidorController::class);

    Route::apiResource("oportunidade", \App\Http\Controllers\Api\OportunidadEtapaController::class);

    Route::apiResource("oportunidadg", \App\Http\Controllers\Api\OportunidadGeneralController::class);

    Route::get("oportunidadh/search", [ \App\Http\Controllers\Api\OportunidadHeaderController::class, 'search' ]);
    Route::apiResource("oportunidadh", \App\Http\Controllers\Api\OportunidadHeaderController::class);

    Route::apiResource("oportunidadp", \App\Http\Controllers\Api\OportunidadPotencialController::class);

    Route::apiResource("oportunidads", \App\Http\Controllers\Api\OportunidadSocioNegocioController::class);

    Route::apiResource("personacontacto", \App\Http\Controllers\Api\PersonaContactoController::class);

    Route::apiResource("sociod", \App\Http\Controllers\Api\SocioDireccionController::class);
    Route::apiResource("sociog", \App\Http\Controllers\Api\SocioGeneralController::class);
    Route::apiResource("socioh", \App\Http\Controllers\Api\SocioHeaderController::class);
    Route::apiResource("sociopc", \App\Http\Controllers\Api\SocioPersonaContactoController::class);

    Route::group([
      'middleware' => 'auth:api'
    ], function() {

    });
});

//Route::get("login", [ \App\Http\Controllers\UserController::class, 'login' ]);

