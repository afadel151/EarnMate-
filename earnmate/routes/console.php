<?php

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
    $offers = OfferSubscription::where('done', false);
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
        $subscription->update([
            'completed' => true
        ]);
        $user = $subscription->user;
        $user->update([
            'balance' => $user->balance + $subscription->level->reward
        ]);
    }
})->daily();
