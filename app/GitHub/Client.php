<?php

namespace App\GitHub;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\ClientException;

class Client
{
    private GuzzleHttpClient $client;

    /** Create a new GitHub Client instance. */
    public function __construct(GuzzleHttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * Get a repository.
     *
     * @param string $owner The repository owner
     * @param string $repo  The repository name
     *
     * @return object
     */
    public function repository(string $owner, string $repo): object
    {
        try {
            $response = $this->client->get("repos/{$owner}/{$repo}");
        } catch (ClientException $exception) {
            // throw new GitHubClientException('Failed to fetch a response', 0, $exception);
            return json_decode('{}');
        }

        return json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);
    }
}
