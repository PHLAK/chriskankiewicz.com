<?php

declare(strict_types=1);

namespace App\Clients\GitHub;

use App\Exceptions\GitHubClientException;

interface GitHubClientInterface
{
    /** @throws GitHubClientException */
    public function repository(string $owner, string $repo): object;
}
