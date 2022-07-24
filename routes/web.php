<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::view('/login', 'auth.login')->name('auth.login-view');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::group(['middleware' => ['auth']], function (){
    Route::get('profile', [ProfileController::class, 'displayProfile'])->name('profile-view');
});

Route::get('/', function () {
    return view('welcome');
});
