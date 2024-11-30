<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Admin extends Model
{
    protected $fillable = [
        'RIP',
        'user_id',
        'balance'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function deposits() : HasMany
    {
        return $this->hasMany(Deposit::class);
    }
    public function withdrawals() : HasMany 
    {
        return $this->hasMany(Withdrawal::class);
    }
    public function tasks() : HasMany 
    {
        return $this->hasMany(Task::class);
    }
    public function done_tasks() : HasMany
    {
        return $this->hasMany(DoneTask::class);
    }
    public function offers():HasMany{
        return $this->hasMany(OfferSubscription::class);
    }
}
