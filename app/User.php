<?php

namespace App;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * The User model.
 *
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 */
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'api_token',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $hidden = [
        'password', 'remember_token', 'admin', 'api_token',
    ];
}
