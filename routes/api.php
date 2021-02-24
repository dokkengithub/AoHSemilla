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

    Route::apiResource("oportunidada", \App\Http\Controllers\OportunidadActividadController::class);

    Route::apiResource("oportunidadan", \App\Http\Controllers\OportunidadAnexoController::class);

    Route::apiResource("oportunidadc", \App\Http\Controllers\OportunidadCompetidorController::class);

    Route::apiResource("oportunidade", \App\Http\Controllers\OportunidadEtapaController::class);

    Route::apiResource("oportunidadg", \App\Http\Controllers\OportunidadGeneralController::class);

    Route::get("oportunidadh/search", [ \App\Http\Controllers\OportunidadHeaderController::class, 'search' ]);
    Route::apiResource("oportunidadh", \App\Http\Controllers\OportunidadHeaderController::class);

    Route::apiResource("oportunidadp", \App\Http\Controllers\OportunidadPotencialController::class);

    Route::apiResource("oportunidads", \App\Http\Controllers\OportunidadSocioNegocioController::class);

    Route::apiResource("personacontacto", \App\Http\Controllers\PersonaContactoController::class);

    Route::apiResource("sociod", \App\Http\Controllers\SocioDireccionController::class);
    Route::apiResource("sociog", \App\Http\Controllers\SocioGeneralController::class);
    Route::apiResource("socioh", \App\Http\Controllers\SocioHeaderController::class);
    Route::apiResource("sociopc", \App\Http\Controllers\SocioPersonaContactoController::class);

    Route::group([
      'middleware' => 'auth:api'
    ], function() {

    });
});

//Route::get("login", [ \App\Http\Controllers\UserController::class, 'login' ]);

