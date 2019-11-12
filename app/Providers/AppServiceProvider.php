<?php

namespace App\Providers;

use App\GitHub\CachedClient as CachedGitHubClient;
use App\GitHub\Client as GitHubClient;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('components.heading', 'heading');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GitHubClient::class, function ($app) {
            return new CachedGitHubClient(config('services.github.token'));
        });
    }
}
