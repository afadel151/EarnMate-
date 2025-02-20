<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable 
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

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
        'balance',
    ];
    protected $appends = ['current_level','inviter'];
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
        return $this->hasMany(DoneTask::class, 'user_id');
    }
    public function admin() : HasOne
    {
        return $this->hasOne(Admin::class);
    }
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
    public function friends(): HasMany 
    {
        return $this->hasMany(Reference::class, 'referrer_id');
    }
    public function bonuses(): HasMany{
        return $this->hasMany(Bonus::class);
    }
    public function getCurrentLevelAttribute()
    {
        return $this->subscriptions()->where('completed', false)->exists()
            ? $this->subscriptions()->where('completed', false)->first()->load('level')
            : 'No_subscription';
    }
    public function offers():HasMany
    {
        return $this->hasMany(OfferSubscription::class);
    }

    public function invitation(): BelongsTo {
        return $this->belongsTo(Reference::class, 'referenced_id');
    }
    public function getInviterAttribute()       
    {
        return $this->invitation()->exists() 
        ? $this->invitation()->user 
        : 'No_inviter';
    }   
    public function messages() : HasMany
    {
        return $this->hasMany(Message::class);
    } 
    public function primary_tasks()
    {
        return $this->hasMany(DonePrimaryTask::class);
    }
}
