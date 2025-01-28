<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InviteOffer extends Model
{
    protected $fillable = [
        'invite',
        'reward',
        'closed'
    ];
}
