<?php

declare(strict_types=1);

namespace App\Factories;

use App\Clients\Blog\BlogClientInterface;
use App\Clients\Blog\LiveBlogClient;
use App\Decorators\CachedBlogClient;
use DI\Attribute\Inject;
use Symfony\Contracts\Cache\CacheInterface;

class BlogClientFactory
{
    #[Inject('blog_feed_url')]
    private string $feedUrl;

    #[Inject(CacheInterface::class)]
    private CacheInterface $cache;

    public function __invoke(): BlogClientInterface
    {
        $liveBlogClient = new LiveBlogClient($this->feedUrl);

        return new CachedBlogClient($liveBlogClient, $this->cache);
    }
}
