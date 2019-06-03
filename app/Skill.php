<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use SoftDeletes;

    /** @var array The attributes that are mass assignable. */
    protected $fillable = ['name', 'proficiency'];

    /** @var array The attributes that should be hidden for arrays. */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Get the text size Tailwind class name based on the proficiency.
     *
     * @return string
     */
    public function textSize(): string
    {
        if (in_array($this->proficiency, range(0, 15))) {
            return 'text-sm';
        }

        if (in_array($this->proficiency, range(16, 35))) {
            return 'text-base';
        }

        if (in_array($this->proficiency, range(66, 85))) {
            return 'text-xl';
        }

        if (in_array($this->proficiency, range(86, 100))) {
            return 'text-2xl';
        }

        return 'text-lg';
    }
}
