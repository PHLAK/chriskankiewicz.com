<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * The Experience model.
 *
 * @method static \Database\Factories\ExperienceFactory factory(...$parameters)
 */
class Experience extends Model
{
    use HasFactory;
    use SoftDeletes;

    // NOTE: Temporary workaround for broken pluralizer
    /** @var string The table associated with the model. */
    protected $table = 'experiences';

    protected $fillable = [
        'company', 'title', 'description', 'start_date', 'end_date', 'location',
    ];

    protected $dates = ['start_date', 'end_date'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $with = ['skills'];

    /** Get the experience's skills. */
    public function skills()
    {
        return $this->morphToMany('App\Skill', 'skillable');
    }
}
