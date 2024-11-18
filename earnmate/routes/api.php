<?php 


use App\Http\Controllers\LevelController;
use Illuminate\Support\Facades\Route;

Route::prefix('/api')->group(function (){
    Route::prefix('/levels')->group(function (){
        Route::get('/get-level', [LevelController::class, 'info'])->name('level.info');
    });
    Route::prefix('/admin')->group(function () {

    });

});