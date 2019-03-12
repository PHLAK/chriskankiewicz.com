<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    /** @var array The attributes that are mass assignable. */
    protected $fillable = ['name'];
}
