<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Mockery;
use App\Libs\GitHubClient;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Mock the GitHubClient by overriding the instantiated object in the
     * application service container.
     *
     * @param callable $callback
     *
     * @return void
     */
    protected function mockGitHubClient(callable $callback)
    {
        $gitHubClient = Mockery::mock(GitHubClient::class);
        $callback($gitHubClient);

        $this->app->instance(GitHubClient::class, $gitHubClient);
    }
}
