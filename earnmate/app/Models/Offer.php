<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offer extends Model
{
    protected $fillable = [
        'start_date',
        'start_time',
        'days',
        'real_max_users',
        'fake_max_users',
        'required_amount',
        'percentage',
        'method'
    ];
    public function subscriptions() : HasMany
    {
        return $this->hasMany(OfferSubscription::class);
    }
    public function scopeActive($query)
    {
        return $query->whereRaw("CONCAT(start_date, ' ', start_time) <= ?", [now()])
                    ->where('start_date', '>=', now()->toDateString());
    }
}
