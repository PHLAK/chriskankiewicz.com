<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

/**
 * The Post model.
 *
 * @method static \Database\Factories\PostFactory factory(...$parameters)
 */
class Post extends Model implements Feedable
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

    /** The "booted" method of the model. */
    protected static function booted(): void
    {
        static::addGlobalScope('published', function (Builder $builder) {
            $builder->whereDate('published_at', '<=', Carbon::now())->orderBy('published_at', 'DESC');
        });
    }

    /** Return a list of posts for the feed. */
    public static function forFeed()
    {
        return self::all();
    }

    /** The tags that belong to the post. */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /** Get the excerpt for the post. */
    public function excerpt(): string
    {
        return Str::of($this->body)->between('<!-- excerpt -->', '<!-- endexcerpt -->');
    }

    /** Determine if the post has an excerpt. */
    public function hasExcerpt(): bool
    {
        return Str::of($this->body)->containsAll(['<!-- excerpt -->', '<!-- endexcerpt -->']);
    }

    /** Get the URL for the post. */
    public function url(): string
    {
        return route('post', $this->slug);
    }

    /** Return the model as a feed item. */
    public function toFeedItem(): FeedItem
    {
        return FeedItem::create([
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'summary' => $this->excerpt(),
            'updated' => $this->published_at,
            'link' => $this->url(),
            'author' => 'Chris Kankiewicz',
        ]);
    }
}
