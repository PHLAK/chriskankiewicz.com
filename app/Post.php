<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    /** @var array The attributes that are mass assignable. */
    protected $fillable = ['slug', 'title', 'body', 'featured_image'];

    /** @var array The attributes that should be mutated to dates. */
    protected $dates = ['published_at'];

    /** @var array The attributes that should be hidden for arrays. */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /** The tags that belong to the post. */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
