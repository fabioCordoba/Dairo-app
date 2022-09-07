<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);

Route::group(['middleware'=>['auth:api']], function () {
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);

    Route::post('/domicilios/user', [App\Http\Controllers\DomicilioController::class, 'misDomicilios']);
    Route::get('/domicilios/libres', [App\Http\Controllers\DomicilioController::class, 'domiciliosLibres']);
    Route::post('/domicilios/autoasignar', [App\Http\Controllers\DomicilioController::class, 'autoAsignar']);
    Route::post('/domicilios/encamino', [App\Http\Controllers\DomicilioController::class, 'encamino']);
    Route::post('/bonificados/pagos', [App\Http\Controllers\DomicilioController::class, 'bonificados']);
    Route::post('/domicilios/pagos', [App\Http\Controllers\DomicilioController::class, 'domiciliosPagados']);

    Route::get('/admins', function () {
        
        return response([
            'admins' => User::whereHas('roles',function ($q){
                $q->where('name', 'ADMINISTRADOR');
            })->get(),
        ], 200);
    });
});





