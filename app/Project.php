<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @var array The attributes that are mass assignable. */
    protected $fillable = ['name', 'description', 'project_url', 'source_url'];
}
