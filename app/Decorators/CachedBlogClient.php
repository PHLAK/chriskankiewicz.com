<?php

declare(strict_types=1);

namespace App\Decorators;

use App\Clients\Blog\BlogClientInterface;
use App\Exceptions\BlogClientException;
use DateInterval;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class CachedBlogClient implements BlogClientInterface
{
    public function __construct(
        private BlogClientInterface $blog,
        private CacheInterface $cache,
    ) {}

    public function posts(?int $limit = null): array
    {
        return $this->cache->get(sprintf('blog-posts-%d', $limit), function (ItemInterface $item) use ($limit): array {
            try {
                $posts = $this->blog->posts($limit);
            } catch (BlogClientException) {
                $item->expiresAfter(DateInterval::createFromDateString('15 minutes'));

                return $item->isHit() ? $item->get() : [];
            }

            $item->expiresAfter(DateInterval::createFromDateString('12 hours'));

            return $posts;
        });
    }
}
