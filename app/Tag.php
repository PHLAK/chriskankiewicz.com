<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;

    /** @var array The attributes that are mass assignable. */
    protected $fillable = ['slug', 'name'];

    /** @var array The attributes that should be hidden for arrays. */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /** The posts that belong to the tag. */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }
}
