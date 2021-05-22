<?php

namespace App\Providers;

use App\GitHub\CachedClient as CachedGitHubClient;
use App\GitHub\Client as GitHubClient;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /** Bootstrap any application services. */
    public function boot()
    {
        // ...
    }

    /** Register any application services. */
    public function register()
    {
        $this->app->bind(GitHubClient::class, function (): GitHubClient {
            return new GitHubClient(
                new Client([
                    'base_uri' => config('services.github.base_uri'),
                    'connect_timeout' => 5,
                    'headers' => [
                        'Authorization' => sprintf('Token %s', config('services.github.token')),
                    ],
                    'timeout' => 10,
                ])
            );
        });

        $this->app->extend(GitHubClient::class, function (GitHubClient $client) {
            return new CachedGitHubClient($client);
        });
    }
}
