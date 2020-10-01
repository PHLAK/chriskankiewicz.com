<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use HasFactory;
    use SoftDeletes;

    /** @var array The attributes that are mass assignable. */
    protected $fillable = ['name', 'icon_name', 'icon_style'];

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
     * Determine if this skill has an icon.
     *
     * @return bool
     */
    public function hasIcon(): bool
    {
        return isset($this->icon_style, $this->icon_name);
    }

    /**
     * Get the skill's icon style classes.
     *
     * @param array $extraStyles Array of extra style class names
     *
     * @return string
     */
    public function iconStyles(array $extraStyles = []): string
    {
        $styles = "{$this->icon_style} fa-{$this->icon_name}";

        foreach ($extraStyles as $style) {
            $styles .= " {$style}";
        }

        return $styles;
    }

    /**
     * Get the skill's icon markup.
     *
     * @param array $extraStyles Array of extra style class names
     *
     * @return string
     */
    public function iconMarkup(array $extraStyles = []): string
    {
        return "<i class=\"{$this->iconStyles($extraStyles)}\"></i>";
    }
}
