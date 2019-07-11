<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /** @var array The attributes that are mass assignable. */
    protected $fillable = [
        'name', 'email', 'password', 'api_token'
    ];

    /** @var array The attributes that should be hidden for arrays. */
    protected $hidden = [
        'password', 'remember_token', 'admin', 'api_token'
    ];

    /**
     * Determine if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->admin;
    }
}
