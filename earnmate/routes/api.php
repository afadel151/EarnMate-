<?php 


use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WithdrawalController;
use App\Models\DoneTask;
use App\Models\OfferSubscription;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

Route::prefix('/api')->group(function (){
    Route::get('/user/withdrawals', [UserController::class, 'getUserWeeklyWithdrawals']);
    Route::get('/dzd-price', [UserController::class, 'getDzdPrice']);
    Route::prefix('/levels')->group(function (){
        Route::get('/get-level', [LevelController::class, 'info'])->name('level.info');
        Route::post('/subscribe', [LevelController::class, 'subscribe']);
    });
    Route::prefix('/deposits')->group(function (){
        Route::get('/getrip',[DepositController::class, 'getrip']);
        Route::post('/baridi', [DepositController::class, 'baridi']);
        Route::post('/binance', [DepositController::class, 'binance']);
    });
    Route::post('/messages/add', [MessageController::class, 'add_user']);
    Route::prefix('/withdrawals')->group(function (){
        Route::post('/withdraw_baridi', [WithdrawalController::class, 'withdraw_baridi']);
        Route::post('/withdraw_binance', [WithdrawalController::class, 'withdraw_binance']);
        Route::post('/withdraw_bybit', [WithdrawalController::class, 'withdraw_bybit']);
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
        Route::get('/schedule/subscriptions', [AdminController::class, 'schedule_subs'])->name('schedule.subscription');
        Route::get('/schedule/offer',[AdminController::class, 'schedule_offs'])->name('schedule.offers');
        Route::prefix('/tasks')->group(function(){
            Route::get('/', [TaskController::class, 'gettasks']);
            Route::post('/add', [TaskController::class, 'add']);
            Route::post('/edit_status',[TaskController::class,'edit_status']);
        });
        Route::post('/messages/add', [MessageController::class, 'add_admin']);
        Route::get('/messages/convs', [MessageController::class, 'get_conversations']);
        Route::post('/config', [ConfigController::class, 'edit']);
        
        // get_conversations
        Route::get('/money_chart_data', [AdminController::class, 'getMoneyChartData']);
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
            Route::post('/edit_status', [OfferController::class, 'edit_status']);
            
            
        });
        Route::prefix('/admins')->group(function (){
            Route::post('/add', [AdminController::class, 'add'])->name('admims.add');
        });
    });

})->middleware(['auth:sanctum','auth']);