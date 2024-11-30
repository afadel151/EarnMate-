<?php 


use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WithdrawalController;
use Illuminate\Support\Facades\Route;

Route::prefix('/api')->group(function (){
    
    Route::prefix('/levels')->group(function (){
        Route::get('/get-level', [LevelController::class, 'info'])->name('level.info');
        Route::post('/subscribe', [LevelController::class, 'subscribe']);
    });
    Route::prefix('/deposits')->group(function (){
        Route::get('/getrip',[DepositController::class, 'getrip']);
        Route::post('/baridi', [DepositController::class, 'baridi']);
    });
    Route::prefix('/withdrawals')->group(function (){
        Route::post('/withdraw_baridi', [WithdrawalController::class, 'withdraw_baridi']);
    });
    Route::prefix('/tasks')->group(function(){
        Route::post('/confirm', [TaskController::class, 'confirm']);
    });
    Route::prefix('offers')->group(function (){
        Route::get('/can', [OfferController::class, 'can']);
        Route::post('/baridi', [OfferController::class, 'baridi']);
        Route::post('/binance', [OfferController::class, 'binance']);
        Route::post('/bybit', [OfferController::class, 'bybit']);
    });
    // withdraw_baridi
    Route::middleware(\App\Http\Middleware\AdminMiddleware::class)->prefix('/admin')->group(function () {
        Route::prefix('/tasks')->group(function(){
            Route::get('/', [TaskController::class, 'gettasks']);
            Route::post('/add', [TaskController::class, 'add']);
            Route::post('/edit_status',[TaskController::class,'edit_status']);
        });
        Route::prefix('/withdrawals')->group(function(){
            Route::get('/', [WithdrawalController::class, 'get']);
            Route::post('/edit_status', [WithdrawalController::class, 'edit_status']);
        });
        Route::prefix('/deposits')->group(function(){
            Route::get('/', [DepositController::class, 'get']);
            Route::post('/edit_status', [DepositController::class, 'edit_status']);
        });
        Route::prefix('/offers')->group(function(){
            Route::post('/add', [OfferController::class, 'add']);
       
            
        });
        Route::prefix('/admins')->group(function (){
            Route::post('/add', [AdminController::class, 'add'])->name('admims.add');
        });
    });

})->middleware(['auth:sanctum']);