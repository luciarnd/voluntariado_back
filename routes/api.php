<?php

use App\Http\Controllers\AuthController;
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

Route::get('/voluntariados', [\App\Http\Controllers\VoluntariadosController::class, 'index']);
Route::get('/voluntariado/{voluntariado}', [\App\Http\Controllers\VoluntariadosController::class, 'show']);
Route::post('/voluntariado', [\App\Http\Controllers\VoluntariadosController::class, 'store']);
Route::put('/voluntariado/{voluntariado}', [\App\Http\Controllers\VoluntariadosController::class, 'update']);
Route::delete('/voluntariado/{voluntariado}', [\App\Http\Controllers\VoluntariadosController::class, 'delete']);
Route::get('/subscribirse/{voluntariado}', [\App\Http\Controllers\VoluntariadosController::class, 'subscribirse']);
Route::get('/voluntariado/subscritos/{voluntariado}', [\App\Http\Controllers\VoluntariadosController::class, 'usuariosVoluntariado']);

Route::get('/empresas', [\App\Http\Controllers\EmpresaController::class, 'index']);
Route::get('/empresa/{empresa}', [\App\Http\Controllers\EmpresaController::class, 'show']);
Route::post('/empresa', [\App\Http\Controllers\EmpresaController::class, 'store']);
Route::put('/empresa/{empresa}', [\App\Http\Controllers\EmpresaController::class, 'update']);
Route::delete('/empresa/{empresa}', [\App\Http\Controllers\EmpresaController::class, 'delete']);

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});
