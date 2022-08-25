<?php

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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group(['middleware' => ['role:ROOT|ADMINISTRADOR']], function () {
    Route::middleware(['auth:sanctum', 'verified'])->get('/users', function () {
        return view('users');
    })->name('users');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/domicilios', function () {
    return view('domicilios');
})->name('domicilios');

Route::middleware(['auth:sanctum', 'verified'])->get('/bonificados', function () {
    return view('bonificados');
})->name('bonificados');

Route::middleware(['auth:sanctum', 'verified'])->get('/pagos', function () {
    return view('pagos');
})->name('pagos');

