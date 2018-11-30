<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // News
    public function news() {
        // One-to-Many
        return $this->hasMany('App\News');
    }

    // Comments
    public function comments() {
        // One-to-Many
        return $this->hasMany('App\Comment');
    }

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
