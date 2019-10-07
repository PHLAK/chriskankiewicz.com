<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use SoftDeletes;

    /** @var array The attributes that are mass assignable. */
    protected $fillable = ['name', 'emphasis', 'icon'];

    /** @var array The attributes that should be hidden for arrays. */
    protected $hidden = ['pivot', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * Get all of the experiences that are assigned this skill.
     */
    public function experiences()
    {
        return $this->morphedByMany('App\Experience', 'skillable');
    }

    /**
     * Get all of the projects that are assigned this skill.
     */
    public function projects()
    {
        return $this->morphedByMany('App\Project', 'skillable');
    }

    /**
     * Get the text size Tailwind class name based on the proficiency.
     *
     * @return string
     */
    public function styles(): string
    {
        switch ($this->emphasis) {
            case 1:
                return 'text-gray-900 text-xl';

            case -1:
                return 'text-gray-700 text-xs';

            default:
                return 'text-gray-800 text-base';
        }
    }
}
