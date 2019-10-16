<?php

namespace App\GitHub;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\ClientException;

class Client extends GuzzleHttpClient
{
    /**
     * Create a new GitHub Client instance.
     *
     * @param string $authToken GitHub OAuth token
     * @param array  $config    GuzzleHttp Client config
     */
    public function __construct(string $authToken, $config = [])
    {
        parent::__construct(array_replace_recursive([
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
        try {
            $response = $this->get("repos/{$owner}/{$repo}");
        } catch (ClientException $exception) {
            return json_decode('{}');
        }

        return json_decode($response->getBody()->getContents());
    }
}
