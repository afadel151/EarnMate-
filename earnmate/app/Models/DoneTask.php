<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DoneTask extends Model
{
    protected $table = 'done_tasks';
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function task() : BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
    public function admin() : BelongsTo 
    {
        return $this->belongsTo(Admin::class);
    }
}
