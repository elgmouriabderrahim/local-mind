<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\FavoriteController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminQuestionController;


Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [QuestionController::class, 'index'])->name('home');

    Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('/questions/{question}', [QuestionController::class, 'show'])->whereNumber('question')->name('questions.show');
    Route::post('/questions/{question}/responses', [ResponseController::class, 'store'])->whereNumber('question')->name('responses.store');
    Route::post('/questions/{question}/favorite', [FavoriteController::class, 'toggle'])->whereNumber('question')->name('questions.favorite');

    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    
    Route::prefix('questions')->name('questions.')->group(function() {
    Route::get('/', [AdminQuestionController::class, 'index'])->name('index');
    Route::get('/{question}', [AdminQuestionController::class, 'show'])->name('show');
    Route::delete('/{question}', [AdminQuestionController::class, 'destroy'])->name('destroy');
    });
});