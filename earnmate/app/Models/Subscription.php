<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'level_id',
        'method'
    ];
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    
    }
    public function level() : BelongsTo {
        return $this->belongsTo(Level::class);
    }
}
