<?php

namespace App;

use Database\Factories\AccomplishmentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * The Accomplishment model.
 *
 * @method static \Database\Factories\AccomplishmentFactory factory(...$parameters)
 */
class Accomplishment extends Model
{
    /** @use HasFactory<AccomplishmentFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['description'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
