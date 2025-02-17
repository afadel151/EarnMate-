<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonePrimaryTask extends Model
{
    protected $fillable = [
        'primary_task_id',
        'user_id',
        'image',
        'status'
    ];
    public function primary_task()
    {
        return $this->belongsTo(PrimaryTask::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
