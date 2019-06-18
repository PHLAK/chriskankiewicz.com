<?php

namespace App\Libs;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;
use GuzzleHttp\Exception\ClientException;

class CachedGitHubClient extends GitHubClient
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

        return Cache::remember($key, Carbon::now()->addHours(6), function () use ($owner, $repo) {
            try {
                return parent::repository($owner, $repo);
            } catch (ClientException $exception) {
                return json_decode('{}');
            }
        });
    }
}
