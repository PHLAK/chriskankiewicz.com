<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libs\GitHubClient;
use App\Libs\CachedGitHubClient;

class GitHubProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return object
     */
    public function register()
    {
        $this->app->bind(GitHubClient::class, function ($app) {
            return new CachedGitHubClient(config('services.github.token'));
        });
    }
}
