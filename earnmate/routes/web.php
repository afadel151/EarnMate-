<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/statistics',[UserController::class, 'statistics'] )->name('statistics');
    Route::get('/deposit', [UserController::class, 'deposit'])->name('deposit');
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
});
Route::get('/landing', function(){
    return Inertia::render('Landing');
});
Route::middleware( \App\Http\Middleware\AdminMiddleware::class)->prefix('/admin')->group(function (){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
}); 
Route::get('/auth/{provider}/redirect', [SocialController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialController::class, 'callback']);

require __DIR__.'/auth.php';
require __DIR__.'/api.php';
