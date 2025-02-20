<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reference extends Model
{
    protected $table = 'referrences';
    protected $fillable = [
        'referrer_id',
        'referenced_id'
    ];
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }
    public function friend() : BelongsTo
    {
        return $this->belongsTo(User::class, 'referenced_id');
    }
}
