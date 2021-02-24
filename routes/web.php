<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return "Web: Bienvenido";
});

Route::get('reset', function (){
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('optimize');

    return "Reset ejecutado.";
});


Route::resource('oportunidad-header', App\Http\Controllers\Api\OportunidadHeaderController::class)->except('create', 'edit');

Route::resource('oportunidad-actividad', App\Http\Controllers\Api\OportunidadActividadController::class)->except('create', 'edit');

Route::resource('oportunidad-anexo', App\Http\Controllers\Api\OportunidadAnexoController::class)->except('create', 'edit');

Route::resource('oportunidad-competidor', App\Http\Controllers\Api\OportunidadCompetidorController::class)->except('create', 'edit');

Route::resource('oportunidad-etapa', App\Http\Controllers\Api\OportunidadEtapaController::class)->except('create', 'edit');

Route::resource('oportunidad-general', App\Http\Controllers\Api\OportunidadGeneralController::class)->except('create', 'edit');

Route::resource('oportunidad-potencial', App\Http\Controllers\Api\OportunidadPotencialController::class)->except('create', 'edit');

Route::resource('oportunidad-socio-negocio', App\Http\Controllers\Api\OportunidadSocioNegocioController::class)->except('create', 'edit');

Route::resource('socio-header', App\Http\Controllers\Api\SocioHeaderController::class)->except('create', 'edit');

Route::resource('socio-direccion', App\Http\Controllers\Api\SocioDireccionController::class)->except('create', 'edit');

Route::resource('socio-general', App\Http\Controllers\Api\SocioGeneralController::class)->except('create', 'edit');

Route::resource('socio-persona-contacto', App\Http\Controllers\Api\SocioPersonaContactoController::class)->except('create', 'edit');

Route::resource('persona-contacto', App\Http\Controllers\Api\PersonaContactoController::class)->except('create', 'edit');
