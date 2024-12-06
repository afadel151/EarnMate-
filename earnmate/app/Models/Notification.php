<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'text'
    ];
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
