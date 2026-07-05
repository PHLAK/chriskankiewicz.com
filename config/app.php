<?php

declare(strict_types=1);

use function DI\env;

return [

    'debug' => env('APP_DEBUG', false),

    'date_format' => env('DATE_FORMAT', 'Y-m-d H:i:s'),

    'timezone' => env('TIMEZONE', date_default_timezone_get()),

    'github_base_uri' => env('GITHUB_BASE_URI', 'https://api.github.com/'),

    'github_token' => env('GITHUB_TOKEN'),

    'blog_feed_url' => env('BLOG_FEED_URL', 'https://blog.chriskankiewicz.com/feed'),

    'projects' => [
        'phlak/plume',
        'directorylister/directorylister',
        'phlak/twine',
        'phlak/splat',
        'phlak/semver',
        'phlak/vuecolorclock',
        'phlak/stash',
        'phlak/config',
        'phlak/chronometer',
        'phlak/uses',
        // '...',
        // '...',
    ],

];
