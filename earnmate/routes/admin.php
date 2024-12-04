<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OfferController;
use App\Models\DoneTask;
use App\Models\OfferSubscription;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Translation\MessageCatalogue;

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
        Route::get('/subscribers', [OfferController::class, 'subscribers'])->name('admin.offer_subscribers');
    });
    Route::prefix('/messages')->group(function () {
        Route::get('/', [AdminController::class, 'messages'])->name('admin.messages');
        Route::get('/{id}',[MessageController::class, 'user'])->name('admin.messages.user');
    });
    Route::prefix('/admins')->group(function () {
        Route::get('/', [AdminController::class, 'admins'])->name('admin.admins');
        
    });
    Route::get('/schedule/subscriptions', function () {
        $subscriptions = Subscription::where('completed', false)
        ->whereDate('created_at', Carbon::now()->subDays(5))
        ->get();
        foreach ($subscriptions as $subscription) {
            $startDate = Carbon::now()->subDays(5);
            $userTasks = DoneTask::where('user_id',$subscription->user_id)->where(function ($query) use ($startDate){
                $query->whereDate('created_at','>=',$startDate)
                        ->whereDate('created_at','<=',Carbon::today());
            })->get();
            $activeTasks = $userTasks->count() - $userTasks->where('status','confirmed')->count();
            if ($activeTasks < 5) {
                $subscription->update([
                    'completed' => true
                ]);
                $user = $subscription->user;
                $user->update([
                    'balance' => $user->balance + $subscription->level->reward
                ]);
            }else {
                $subscription->update([
                    'completed' => true
                ]);
            }
        }
        return $subscriptions;
    });
    Route::get('/schedule/offer',function (){
        $offers = OfferSubscription::where('done', false)->where('status','confirmed')->get();
        foreach ($offers as $offer) {
            $level_days = $offer->offer->days;
            if ($offer->created_at == Carbon::now()->subDays($level_days)) {
                $offer->update([
                    'done' => true
                ]);
                $user = $offer->user;
                $user->update([
                    'balance' => $user->balance + $offer->offer->amount + $offer->offer->amount*$offer->offer->percentage/100
                ]);
            }
        }
        return $offers;
    });
    Route::prefix('/users')->group(function () {
        Route::get('/', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/{id}', [AdminController::class, 'user'])->name('admin.user');
    });
    
});