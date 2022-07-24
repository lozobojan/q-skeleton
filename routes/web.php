<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;


Route::view('/login', 'auth.login')->name('auth.login-view');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/', function () {
    return view('welcome');
});
