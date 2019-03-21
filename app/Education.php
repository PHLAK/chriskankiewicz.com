<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
    use SoftDeletes;

    /** @var array The attributes that are mass assignable. */
    protected $fillable = [
        'institution', 'degree', 'start_date', 'end_date', 'currently_enrolled'
    ];

    /** @var array The attributes that should be mutated to dates. */
    protected $dates = ['start_date', 'end_date'];

    /** @var array The attributes that should be cast to native types. */
    protected $casts = [
        'currently_enrolled' => 'boolean',
    ];
}
