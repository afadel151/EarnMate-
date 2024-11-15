<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Level extends Model
{
    public function subscriptions(): HasMany
    {
        return $this->HasMany(Subscription::class);
    }
}
