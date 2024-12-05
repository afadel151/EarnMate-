<?php
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\DoneTask;
use App\Models\OfferSubscription;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;

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
Route::get('/admin/run_subscription_schedule', function () {
    $subscriptions = Subscription::where('completed', false)
        ->whereDate('created_at', Carbon::now()->subDays(0))
        ->get();

    $offers = OfferSubscription::where('done', false)->where('status', 'confirmed')->get();
    foreach ($offers as $offer) {
        $level_days = $offer->offer->days;
        if ($offer->created_at == Carbon::now()->subDays($level_days)) {
            $offer->update([
                'done' => true
            ]);
            $user = $offer->user;
            $user->update([
                'balance' => $user->balance + $offer->offer->amount + $offer->offer->amount * $offer->offer->percentage / 100
            ]);
        }
    }
    foreach ($subscriptions as $subscription) {
        $startDate = Carbon::now()->subDays(5);
        $userTasks = DoneTask::where('user_id', $subscription->user_id)->where(function ($query) use ($startDate) {
            $query->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', Carbon::today());
        })->get();
        $activeTasks = $userTasks->count() - $userTasks->where('status', 'confirmed')->count();
        if ($activeTasks < 5) {
            $subscription->update([
                'completed' => true
            ]);
            $user = $subscription->user;
            echo $user->balance + $subscription->level->reward;
            $user->update([
                'balance' => $user->balance + $subscription->level->reward
            ]);

            echo 'done';
        } else {
            // echo 'yes';
            $subscription->update([
                'completed' => 1
            ]);
            echo 'no';
        }
    }
    return 'Task executed successfully';
})->middleware(['auth','auth:sanctum',AdminMiddleware::class]);

Route::middleware(['auth', 'auth:sanctum'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::prefix('deposits')->group(function (){
        Route::get('/', [UserController::class, 'deposits'])->name('deposits');
    });
    Route::get('/help', [UserController::class, 'help'])->name('help');
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
    Route::prefix('messages')->group(function (){
        Route::get('/', [MessageController::class, 'index'] )->name('messages');
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
