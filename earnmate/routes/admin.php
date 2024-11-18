<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::middleware( \App\Http\Middleware\AdminMiddleware::class)->prefix('/admin')->group(function (){
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/profile',[AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/deposits',[AdminController::class, 'deposits'])->name('admin.deposits');
    Route::get('/withdrawals',[AdminController::class, 'withdrawals'])->name('admin.withdrawals');
    Route::get('/tasks',[AdminController::class, 'tasks'])->name('admin.tasks');
    Route::get('/offers',[AdminController::class, 'offers'])->name('admin.offers');
    Route::get('/messages',[AdminController::class, 'messages'])->name('admin.messages');
    Route::get('/{id}', [AdminController::class, 'show'])->name('admin.show');
});