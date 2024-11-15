<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    public function user(): BelongsTo 
    {
        return $this->belongsTo(related: User::class);

    }
    public function admin(): BelongsTo
    {
        return $this->belongsTo(related: Admin::class);
    }
}
