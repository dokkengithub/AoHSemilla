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
/*
Route::get('/', function () {
    return "Bienvenido";
});
*/

Route::get('reset-config', function (){

    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('optimize');
    //Artisan::call('optimize:clear');
    //Artisan::call('storage:link');

    //Artisan::call('composer install --optimize-autoloader');

    //Artisan::call('composer install --optimize-autoloader --nodev');

    Artisan::call('key:generate');

    return Response::json(
        [
            'status' => true,
            'message' => "Configuración realizada.."
        ],
        200
    );
});


Route::group([
    'prefix' => 'aoh',
    'middleware' => ['json.response']
], function () {

    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::post('login', [ \App\Http\Controllers\Api\Auth\AuthController::class, 'login' ]);
        //Route::post('logout', [ \App\Http\Controllers\Api\Auth\AuthController::class, 'logout' ]);

        Route::group([
            'middleware' => [ 'auth:sanctum', 'cors' ]
          ], function() {

            Route::post('logout', [ \App\Http\Controllers\Api\Auth\AuthController::class, 'logout' ]);
            Route::get('user', [ \App\Http\Controllers\Api\Auth\AuthController::class, 'user' ]);
        });
    });

    Route::group([
        'prefix' => 'account'
    ], function () {

        Route::group([
            'middleware' => [ 'auth:sanctum', 'cors' ]
          ], function() {
            Route::apiResource(
                'user',
                \App\Http\Controllers\Api\Auth\UserController::class
            )->parameters(['user' => 'id']);
        });


    });


    Route::group([
      'middleware' => [ 'auth:sanctum', 'cors' ]
    ], function() {
        Route::apiResource("oportunidada", \App\Http\Controllers\Api\OportunidadActividadController::class)->parameters(['oportunidada' => 'id']);
        Route::apiResource("oportunidadan", \App\Http\Controllers\Api\OportunidadAnexoController::class)->parameters(['oportunidadan' => 'id']);
        Route::apiResource("oportunidadc", \App\Http\Controllers\Api\OportunidadCompetidorController::class)->parameters(['oportunidadc' => 'id']);
        Route::apiResource("oportunidade", \App\Http\Controllers\Api\OportunidadEtapaController::class)->parameters(['oportunidade' => 'id']);
        Route::apiResource("oportunidadg", \App\Http\Controllers\Api\OportunidadGeneralController::class)->parameters(['oportunidadg' => 'id']);

        //Route::get("oportunidadh/search", [ \App\Http\Controllers\Api\OportunidadHeaderController::class, 'search' ]);
        //Route::apiResource("oportunidadh", \App\Http\Controllers\Api\OportunidadHeaderController::class)->parameters(['oportunidadh' => 'id']);

        Route::apiResource("oportunidadp", \App\Http\Controllers\Api\OportunidadPotencialController::class)->parameters(['oportunidadp' => 'id']);
        Route::apiResource("oportunidads", \App\Http\Controllers\Api\OportunidadSocioNegocioController::class)->parameters(['oportunidads' => 'id']);
        Route::apiResource("personacontacto", \App\Http\Controllers\Api\PersonaContactoController::class)->parameters(['personacontacto' => 'id']);
        Route::apiResource("sociod", \App\Http\Controllers\Api\SocioDireccionController::class)->parameters(['sociod' => 'id']);
        Route::apiResource("sociog", \App\Http\Controllers\Api\SocioGeneralController::class)->parameters(['sociog' => 'id']);
        Route::apiResource("socioh", \App\Http\Controllers\Api\SocioHeaderController::class)->parameters(['socioh' => 'id']);
        Route::apiResource("sociopc", \App\Http\Controllers\Api\SocioPersonaContactoController::class)->parameters(['sociopc' => 'id']);

    });

    Route::get("oportunidadh/search", [ \App\Http\Controllers\Api\OportunidadHeaderController::class, 'search' ]);
    Route::apiResource("oportunidadh", \App\Http\Controllers\Api\OportunidadHeaderController::class)->parameters(['oportunidadh' => 'id']);
});


//Route::get("login", [ \App\Http\Controllers\UserController::class, 'login' ]);

/*Route::fallback(function () {
    return "=(";
});*/

/*

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
