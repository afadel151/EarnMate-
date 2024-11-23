<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Withdrawal extends Model
{
    protected $fillable = [
        'user_id',
        'admin_id',
        'destination',
        'method',
        'processed_at',
        'amount',
        'status'
    ];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function admin():BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
}
