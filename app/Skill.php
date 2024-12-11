<?php

namespace App;

use Database\Factories\SkillFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * The Skill model.
 *
 * @method static \Database\Factories\SkillFactory factory(...$parameters)
 */
class Skill extends Model
{
    /** @use HasFactory<SkillFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'icon_name', 'icon_style'];

    protected $hidden = ['pivot', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * Get all of the experiences that are assigned this skill.
     *
     * @return MorphToMany<Experience, self>
     */
    public function experiences(): MorphToMany
    {
        return $this->morphedByMany(Experience::class, 'skillable');
    }

    /**
     * Get all of the projects that are assigned this skill.
     *
     * @return MorphToMany<Project, self>
     */
    public function projects(): MorphToMany
    {
        return $this->morphedByMany(Project::class, 'skillable');
    }

    /** Determine if this skill has an icon. */
    public function hasIcon(): bool
    {
        return isset($this->icon_style, $this->icon_name);
    }

    /**
     * Get the skill's icon style classes.
     *
     * @param array<string> $extraStyles Array of extra style class names
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
     * @param array<string> $extraStyles Array of extra style class names
     */
    public function iconMarkup(array $extraStyles = []): string
    {
        return "<i class=\"{$this->iconStyles($extraStyles)}\"></i>";
    }
}
