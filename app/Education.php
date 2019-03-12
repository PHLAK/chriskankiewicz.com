<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    /** @var array The attributes that are mass assignable. */
    protected $fillable = ['institution', 'degree', 'start_date', 'end_date'];

    /** @var array The attributes that should be mutated to dates. */
    protected $dates = ['start_date', 'end_date'];
}
