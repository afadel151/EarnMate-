<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Landing', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::middleware(['auth', 'auth:sanctum'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::prefix('deposits')->group(function (){
        Route::get('/', [UserController::class, 'deposits'])->name('deposits');
    });
    Route::prefix('statistics')->group(function (){
        Route::get('/',[UserController::class, 'statistics'] )->name('statistics');
    });
    Route::prefix('withdrawals')->group(function (){
        Route::get('/', [UserController::class, 'withdrawals'] )->name('withdrawals');
    });
    Route::prefix('tasks')->group(function (){
        Route::get('/', [UserController::class, 'tasks'] )->name('tasks');
    });
    Route::prefix('offers')->group(function (){
        Route::get('/', [OfferController::class, 'offers'] )->name('offers');
    });
    Route::prefix('bonuses')->group(function (){
        Route::get('/', [UserController::class, 'bonuses'] )->name('bonuses');
    });
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/leaderboard', [UserController::class, 'leaderboard'])->name('leaderboard');
});
Route::get('/landing', function(){
    return Inertia::render('Landing');
});

Route::get('/auth/{provider}/redirect', [SocialController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialController::class, 'callback']);

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/api.php';
