<?php

namespace App\GitHub;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class CachedClient extends Client
{
    /**
     * Get a cached repository.
     *
     * @param string $owner The repository owner
     * @param string $repo  The repository name
     *
     * @return object
     */
    public function repository(string $owner, string $repo): object
    {
        $key = "repository:{$owner}:{$repo}";

        return Cache::remember($key, Carbon::now()->addHours(6)->addMinutes(rand(-120, 120)), function () use ($owner, $repo) {
            return parent::repository($owner, $repo);
        });
    }
}
