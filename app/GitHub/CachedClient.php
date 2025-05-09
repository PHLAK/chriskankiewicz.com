<?php

namespace App\GitHub;

use App\GitHub\Client as GitHubClient;
use Carbon\CarbonInterval;
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
     * @param string $repo The repository name
     */
    public function repository(string $owner, string $repo): object
    {
        return Cache::flexible(
            sprintf('repository:%s:%s', $owner, $repo),
            [CarbonInterval::hours(4), CarbonInterval::hour(24)],
            fn () => $this->client->repository($owner, $repo)
        );
    }
}
