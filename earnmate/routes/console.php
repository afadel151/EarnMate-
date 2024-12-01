<?php

use App\Models\DoneTask;
use App\Models\OfferSubscription;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();#
Schedule::call(function () {
    $subscriptions = Subscription::where('completed', false)
    ->whereDate('created_at', Carbon::now()->subDays(5))
    ->get();
    
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
})->dailyAt('13:00');
