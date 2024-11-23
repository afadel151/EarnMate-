<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'code',
        'google_id',
        'balance'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function withdrawals() : HasMany
    {
        return $this->hasMany(Withdrawal::class);
    }
    public function deposits():HasMany
    {
        return $this->hasMany(Deposit::class);
    }
    public function tasks() : HasMany
    {
        return $this->hasMany(DoneTask::class);
    }
    public function admin() : HasOne
    {
        return $this->hasOne(Admin::class);
    }
    public function subscriptions() : HasMany
    {
        return $this->hasMany(Subscription::class);
    }
    public function friends(): HasMany 
    {
        return $this->hasMany(Reference::class, 'referrer_id');
    }
}
