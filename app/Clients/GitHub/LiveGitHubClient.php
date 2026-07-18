<?php

declare(strict_types=1);

namespace App\Clients\GitHub;

use App\Exceptions\GitHubClientException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class LiveGitHubClient implements GitHubClientInterface
{
    public function __construct(
        private Client $client
    ) {}

    public function repository(string $owner, string $repository): object
    {
        try {
            $response = $this->client->get(sprintf('repos/%s/%s', $owner, $repository));
        } catch (GuzzleException $exception) {
            throw new GitHubClientException('Failed to fetch the repository', previous: $exception);
        }

        return (object) json_decode($response->getBody()->getContents(), flags: JSON_THROW_ON_ERROR);
    }
}
