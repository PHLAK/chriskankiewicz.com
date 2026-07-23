<?php

declare(strict_types=1);

namespace App\Decorators;

use App\Clients\GitHub\GitHubClientInterface;
use App\Exceptions\GitHubClientException;
use DateInterval;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class CachedGitHubClient implements GitHubClientInterface
{
    public function __construct(
        private GitHubClientInterface $github,
        private CacheInterface $cache,
    ) {}

    public function repository(string $owner, string $repository): object
    {
        return $this->cache->get(sprintf('github-%s-%s', $owner, $repository), function (ItemInterface $item) use ($owner, $repository): object {
            try {
                $repository = $this->github->repository($owner, $repository);
            } catch (GitHubClientException) {
                $item->expiresAfter(DateInterval::createFromDateString('1 minute'));

                return (object) [];
            }

            $item->expiresAfter(DateInterval::createFromDateString('8 hours'));

            return $repository;
        });
    }
}
