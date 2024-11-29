<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    ];

}
