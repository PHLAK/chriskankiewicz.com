<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * The Post model.
 *
 * @method static \Database\Factories\PostFactory factory(...$parameters)
 */
class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    /** @var array The attributes that are mass assignable. */
    protected $fillable = [
        'slug', 'title', 'body', 'featured_image_url', 'featured_image_text', 'published_at',
    ];

    /** @var array The attributes that should be mutated to dates. */
    protected $dates = ['published_at'];

    /** @var array The attributes that should be hidden for arrays. */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /** The tags that belong to the post. */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /** Get the URL for the post. */
    public function url(): string
    {
        return route('post', $this->slug);
    }

    /** The "booted" method of the model. */
    protected static function booted(): void
    {
        static::addGlobalScope('published', function (Builder $builder) {
            $builder->orderBy('published_at', 'DESC');
        });
    }
}
