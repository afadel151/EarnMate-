<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfferSubscription extends Model
{
    protected $fillable = [
        'user_id',
        'offer_id',
        'status',
        'done',
        'screenshot',
        'transaction_code',      
        'method',
        'admin_id'
    ];

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

}
