<?php

namespace App\GitHub;

use App\GitHub\Client as GitHubClient;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class CachedClient extends Client
{
    private GitHubClient $client;

    /** Create a new object instance. */
    public function __construct(GitHubClient $client)
    {
        $this->client = $client;
    }

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
        return Cache::remember(
            sprintf('repository:%s:%s', $owner, $repo),
            Carbon::now()->addHours(6)->addMinutes(rand(-120, 120)),
            fn () => $this->client->repository($owner, $repo)
        );
    }
}
