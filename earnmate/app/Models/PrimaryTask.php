<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrimaryTask extends Model
{
    protected $fillable = [
        'description',
        'link'
    ];
}
