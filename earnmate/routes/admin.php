<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::middleware( [\App\Http\Middleware\AdminMiddleware::class,'auth:sanctum'])->prefix('/admin')->group(function (){
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/profile',[AdminController::class, 'profile'])->name('admin.profile');
    Route::prefix('/deposits')->group(function () {
        Route::get('/', [AdminController::class, 'deposits'])->name('admin.deposits');
    });
    Route::prefix('/withdrawals')->group(function () {
        Route::get('/', [AdminController::class, 'withdrawals'])->name('admin.withdrawals');
 
    });
    Route::prefix('/leaderboard')->group(function () {
        Route::get('/', [AdminController::class, 'leaderboard'])->name('admin.leaderboard');
 
    });
    Route::prefix('/tasks')->group(function () {
        Route::get('/', [AdminController::class, 'tasks'])->name('admin.tasks');

    });
    Route::prefix('/done_tasks')->group(function () {
        Route::get('/', [AdminController::class, 'done_tasks'])->name('admin.done_tasks');

    });
    Route::prefix('/offers')->group(function () {
        Route::get('/', [AdminController::class, 'offers'])->name('admin.offers');
 
    });
    Route::prefix('/messages')->group(function () {
        Route::get('/', [AdminController::class, 'messages'])->name('admin.messages');

    });
    Route::prefix('/admins')->group(function () {
        Route::get('/', [AdminController::class, 'admins'])->name('admin.admins');
        
    });
    Route::prefix('/users')->group(function () {
        Route::get('/', [AdminController::class, 'users'])->name('admin.users');
    });
    
});