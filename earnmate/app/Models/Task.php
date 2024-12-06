<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    protected $fillable = [
        'name',
        'type',
        'link',
        'platform',
        'admin_id'
    ];
    public function actions() : HasMany 
    {
        return $this->hasMany(DoneTask::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    
}
