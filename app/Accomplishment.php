<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accomplishment extends Model
{
    use SoftDeletes;

    /** @var array The attributes that are mass assignable. */
    protected $fillable = ['description'];

    /** @var array The attributes that should be hidden for arrays. */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
