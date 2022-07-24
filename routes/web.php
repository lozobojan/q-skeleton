<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::view('/login', 'auth.login')->name('auth.login-view');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');


// Routes that require auth
Route::group(['middleware' => ['auth']], function (){

    // profile-related routes
    Route::get('profile', [ProfileController::class, 'displayProfile'])->name('profile-view');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // author-related routes
    Route::get('authors', [AuthorController::class, 'index'])->name('authors.index');

    // book-related routes
    Route::get('books/create', [BookController::class, 'create'])->name('books.create');
});

Route::get('/', function () {
    return view('welcome');
});
