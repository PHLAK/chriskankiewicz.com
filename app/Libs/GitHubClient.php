<?php

namespace App\Libs;

use GuzzleHttp\Client;

class GitHubClient
{
    /** @var Client GuzzleHttp Client object */
    protected $client;

    /**
     * Create a new GitHubClient instance.
     *
     * @param string $authToken GitHub OAuth token
     * @param array  $config    GuzzleHttp Client config
     */
    public function __construct(string $authToken, $config = [])
    {
        $this->client = new Client(array_replace_recursive([
            'base_uri' => config('services.github.base_uri'),
            'connect_timeout' => 5,
            'headers' => [
                'Authorization' => "Token {$authToken}"
            ],
            'timeout' => 30
        ], $config));
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
        $response = $this->client->get("repos/{$owner}/{$repo}");

        return json_decode($response->getBody()->getContents());
    }
}
