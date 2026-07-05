<?php

declare(strict_types=1);

namespace App\Factories;

use App\Clients\GitHub\GitHubClientInterface;
use App\Clients\GitHub\LiveGitHubClient;
use App\Decorators\CachedGitHubClient;
use DI\Attribute\Inject;
use GuzzleHttp\Client;
use Symfony\Contracts\Cache\CacheInterface;

class GitHubClientFactory
{
    #[Inject('github_base_uri')]
    private string $baseUri;

    #[Inject('github_token')]
    private string $token;

    #[Inject(CacheInterface::class)]
    private CacheInterface $cache;

    public function __invoke(): GitHubClientInterface
    {
        $liveGitHubClient = new LiveGitHubClient(
            new Client([
                'base_uri' => $this->baseUri,
                'connect_timeout' => 5,
                'headers' => [
                    'Authorization' => sprintf('Token %s', $this->token),
                ],
                'timeout' => 10,
            ])
        );

        return new CachedGitHubClient($liveGitHubClient, $this->cache);
    }
}
