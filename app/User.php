<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /** @var array The attributes that are mass assignable. */
    protected $fillable = [
        'name', 'email', 'password', 'api_token'
    ];

    /** @var array The attributes that should be mutated to dates. */
    protected $dates = ['email_verified_at'];

    /** @var array The attributes that should be hidden for arrays. */
    protected $hidden = [
        'password', 'remember_token', 'admin', 'api_token'
    ];

    /** @var array The attributes that should be cast to native types. */
    protected $casts = [
        'is_admin' => 'boolean',
    ];
}
