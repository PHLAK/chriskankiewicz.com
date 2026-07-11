<?php

declare(strict_types=1);

namespace App\Clients\Blog;

use App\Exceptions\BlogClientException;

class LiveBlogClient implements BlogClientInterface
{
    public function __construct(
        private string $feedUrl
    ) {}

    /** @throws BlogClientException */
    public function posts(?int $limit = null): array
    {
        $response = file_get_contents($this->feedUrl);

        $feed = simplexml_load_string($response);

        if (! $feed->channel) {
            throw new BlogClientException('Feed is invalid');
        }

        return array_map(
            fn ($item): array => (array) $item,
            array_slice(iterator_to_array($feed->channel->item, false), 0, $limit)
        );
    }
}
