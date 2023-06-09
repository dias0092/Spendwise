<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'goal_notifications_enabled',
        'transaction_notifications_enabled',
        'monthly_balance_notifications_enabled',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function goal()
    {
        return $this->hasMany(Goal::class);
    }
    public function monthlyBalances()
    {
        return $this->hasMany(MonthlyBalance::class);
    }
    public function setAvatarAttribute($value)
    {
        if ($value) {
            $filename = time() . '.' . $value->getClientOriginalExtension();
            $path = $value->storeAs('avatars', $filename, 'public');
            $this->attributes['avatar'] = $path;
        }
    }

    public function getAvatarAttribute($value)
    {
        if ($value) {
            return Storage::disk('public')->url($value);
        }

        return $value;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
