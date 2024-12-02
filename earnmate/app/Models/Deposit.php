<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deposit extends Model
{
    protected $fillable =[
        'user_id',
        'admin_id',
        'amount',
        'status',
        'method',
        'price',
    ];
    public function admin() : BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }
    
}
