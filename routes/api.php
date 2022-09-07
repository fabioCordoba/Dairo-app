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

    //Route::post('/forgot', 'ForgotPasswordController@forgot');
    //Route::post('/reset', 'ForgotPasswordController@reset');

    //Route::resource('cuentas', App\Http\Controllers\CuentaController::class);
    //Route::get('/cuentas/search/{nombre}', [App\Http\Controllers\CuentaController::class, 'search']);
    //Route::get('/cuentas/miscta/{id}', [App\Http\Controllers\CuentaController::class, 'miscuentas']);

    //Route::resource('movimientos', App\Http\Controllers\MovimientoController::class);
    //Route::get('/movimientos/search/{nombre}', [App\Http\Controllers\MovimientoController::class, 'search']);
    Route::get('/user', function () {
        return User::all();
    });
});



