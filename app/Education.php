<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * The Education model.
 *
 * @method static \Database\Factories\EducationFactory factory(...$parameters)
 */
class Education extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'institution', 'degree', 'start_date', 'end_date',
    ];

    protected $dates = ['start_date', 'end_date'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
