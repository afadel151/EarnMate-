<?php

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
