<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Experience extends Model
{
    use SoftDeletes;

    /** @var array The attributes that are mass assignable. */
    protected $fillable = [
        'company', 'title', 'description', 'start_date', 'end_date', 'current_position', 'location'
    ];

    /** @var array The attributes that should be mutated to dates. */
    protected $dates = ['start_date', 'end_date'];

    /** @var array The attributes that should be cast to native types. */
    protected $casts = [
        'current_position' => 'boolean',
    ];
}
