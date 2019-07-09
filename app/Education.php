<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Parsedown;

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

    /** @var array The attributes that should be hidden for arrays. */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Get the education degree.
     *
     * @param string $value
     *
     * @return string
     */
    public function getDegreeAttribute($value)
    {
        return (new Parsedown)->text($value);
    }
}
