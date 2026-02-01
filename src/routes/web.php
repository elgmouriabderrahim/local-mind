<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\UserController;

Route::middleware('guest')->group(function() {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function() {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [QuestionController::class, 'index'])->name('home');

    Route::get('/questions/{question}', [QuestionController::class, 'show'])->name('questions.show');
    Route::post('/questions/{question}/responses', [ResponseController::class, 'store'])->name('responses.store');
    Route::post('/questions/{question}/favorite', [FavoriteController::class, 'toggle'])->name('questions.favorite');
    Route::get('/questions/{question}', [QuestionController::class, 'show'])->name('questions.show');
    Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');


    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
});
