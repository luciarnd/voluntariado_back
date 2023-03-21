<?php

use App\Http\Controllers\AuthController;
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
Route::post('/voluntariado/{voluntariado}', [\App\Http\Controllers\VoluntariadosController::class, 'update']);
Route::delete('/voluntariado/{voluntariado}', [\App\Http\Controllers\VoluntariadosController::class, 'delete']);
Route::post('/subscribirse/{voluntariado}', [\App\Http\Controllers\VoluntariadosController::class, 'subscribirse']);
Route::get('/voluntariado/subscritos/{voluntariado}', [\App\Http\Controllers\VoluntariadosController::class, 'usuariosVoluntariado']);

Route::get('/empresas', [\App\Http\Controllers\EmpresaController::class, 'index']);
Route::get('/empresa/{empresa}', [\App\Http\Controllers\EmpresaController::class, 'show']);
Route::post('/empresa', [\App\Http\Controllers\EmpresaController::class, 'store']);
Route::put('/empresa/{empresa}', [\App\Http\Controllers\EmpresaController::class, 'update']);
Route::delete('/empresa/{empresa}', [\App\Http\Controllers\EmpresaController::class, 'delete']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/refresh', [AuthController::class, 'refresh']);
Route::get('/me', [AuthController::class, 'me']);

Route::post('/user', [\App\Http\Controllers\UserController::class, 'store']);
Route::get('/user', [\App\Http\Controllers\UserController::class, 'show']);
