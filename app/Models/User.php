<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Rennokki\Rating\Contracts\Rater;
use Rennokki\Rating\Traits\CanRate;

class User extends Authenticatable implements Rater
{
    use HasApiTokens, HasFactory, Notifiable, CanRate;

    protected $appends = [
        'is_admin',
        'is_user',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getIsAdminAttribute(): bool
    {
        return $this->role === 'admin';
    }

    public function getIsUserAttribute(): bool
    {
        return $this->role === 'user';
    }


    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
