<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = [
       'max_balance',
        'level_days',
        'baridi_tax_percentage',
        'binance_tax_percentage',
        'dzd_price',
    ];

}
