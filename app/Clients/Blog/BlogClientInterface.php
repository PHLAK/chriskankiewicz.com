<?php

declare(strict_types=1);

namespace App\Clients\Blog;

use App\Exceptions\BlogClientException;

interface BlogClientInterface
{
    /**
     * @throws BlogClientException
     *
     * @return list<array>
     */
    public function posts(?int $limit = null): array;
}
