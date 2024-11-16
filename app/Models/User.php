<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const TYPE_ADMIN = 'admin';

    const TYPE_MEMBER = 'member';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'google_id',
        'facebook_id',
        'Twitter_id',
        'email',
        'password',
        'avatar',
        'is_active',
        'social_provider',
        'social_id',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

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
        'is_active' => 'boolean',
    ];

    public function admin()
    {
        return $this->roles()->where('name', self::TYPE_ADMIN)->exists();
    }

    public function member()
    {
        return $this->roles()->where('name', self::TYPE_MEMBER)->exists();
    }
    
    public function readHistories()
    {
        return $this->hasMany(ReadHistory::class);  // Một người dùng có thể có nhiều lịch sử đọc
    }
}
