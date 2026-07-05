<?php

declare(strict_types=1);

namespace App\Functions;

class Gravatar extends ViewFunction
{
    public string $name = 'gravatar';

    public function __invoke(string $email, ?int $size = null): mixed
    {
        $hash = md5(strtolower(trim($email)));
        $queryString = http_build_query(['s' => $size]);

        if (! empty($queryString)) {
            $queryString = '?' . $queryString;
        }

        return sprintf('https://www.gravatar.com/avatar/%s%s', $hash, $queryString);
    }
}
