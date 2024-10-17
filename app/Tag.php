<?php

namespace App;

use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * The Tag model.
 *
 * @method static \Database\Factories\TagFactory factory(...$parameters)
 */
class Tag extends Model
{
    /** @use HasFactory<TagFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['slug', 'name'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The posts that belong to the tag.
     *
     * @return BelongsToMany<Post, self>
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }
}
