<?php

namespace App;

use Carbon\Carbon;
use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Feed\FeedItem;

/**
 * The Post model.
 *
 * @method static \Database\Factories\PostFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder publishedBefore(Carbon $date)
 * @method static \Illuminate\Database\Eloquent\Builder publishedAfter(Carbon $date)
 */
class Post extends Model
{
    /** @use HasFactory<PostFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'slug', 'title', 'body', 'featured_image_url', 'featured_image_text', 'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /** Return a list of posts for the feed. */
    public static function forFeed(): Collection
    {
        return self::all();
    }

    /** The "booted" method of the model. */
    protected static function booted(): void
    {
        static::addGlobalScope('published', function (Builder $builder) {
            $builder->whereDate('published_at', '<=', Carbon::now())->orderBy('published_at', 'DESC');
        });
    }

    /**
     * Scope the query to posts published before a specified date.
     *
     * @param Builder<self> $query
     *
     * @return Builder<self>
     */
    public function scopePublishedBefore(Builder $query, Carbon $date): Builder
    {
        return $query->where('published_at', '<', $date);
    }

    /**
     * Scope the query to posts published after a specified date.
     *
     * @param Builder<self> $query
     *
     * @return Builder<self>
     */
    public function scopePublishedAfter(Builder $query, CArbon $date): Builder
    {
        return $query->where('published_at', '>', $date);
    }

    /**
     * The tags that belong to the post.
     *
     * @return BelongsToMany<Tag, self>
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /** Transform and return the body attribute. */
    public function getBodyAttribute(string $body): string
    {
        return preg_replace('/<\/?excerpt>/', '', $body);
    }

    /** Get the excerpt for the post. */
    public function excerpt(): string
    {
        return Str::of($this->attributes['body'])->between('<excerpt>', '</excerpt>');
    }

    /** Determine if the post has an excerpt. */
    public function hasExcerpt(): bool
    {
        return Str::of($this->attributes['body'])->containsAll(['<excerpt>', '</excerpt>']);
    }

    /** Get the URL for the post. */
    public function url(): string
    {
        return route('post', $this->slug);
    }

    /**
     * Return the model as a feed item.
     *
     * TODO: Re-enable when spatie/laravel-feed is working again
     */
    // public function toFeedItem(): FeedItem
    // {
    //     return FeedItem::create([
    //         'id' => $this->id,
    //         'slug' => $this->slug,
    //         'title' => $this->title,
    //         'summary' => $this->excerpt() . "<br><br><a href=\"{$this->url()}\">Read More</a>",
    //         'updated' => $this->published_at,
    //         'link' => $this->url(),
    //         'authorName' => 'Chris Kankiewicz',
    //     ]);
    // }
}
