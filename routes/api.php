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

Route::get('/voluntariados', [\App\Http\Controllers\VoluntariadosController::class, 'index']);
Route::get('/voluntariado/{voluntariado}', [\App\Http\Controllers\VoluntariadosController::class, 'show']);
Route::post('/voluntariado', [\App\Http\Controllers\VoluntariadosController::class, 'store']);
Route::put('/voluntariado/{voluntariado}', [\App\Http\Controllers\VoluntariadosController::class, 'update']);
Route::delete('/voluntariado/{voluntariado}', [\App\Http\Controllers\VoluntariadosController::class, 'delete']);
Route::get('/subscribirse/{voluntariado}', [\App\Http\Controllers\VoluntariadosController::class, 'subscribirse']);
Route::get('/voluntariado/subscritos/{voluntariado}', [\App\Http\Controllers\VoluntariadosController::class, 'usuariosVoluntariado']);
