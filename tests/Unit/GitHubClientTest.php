<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\GitHub\Client as GitHubClient;
use App\GitHub\CachedClient as CachedGitHubClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class GitHubClientTest extends TestCase
{
    public function test_it_can_be_instantiated_from_the_service_container()
    {
        $gitHub = $this->app->make(GitHubClient::class);

        $this->assertInstanceOf(CachedGitHubClient::class, $gitHub);
    }

    public function test_it_can_get_repository_details()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                'id' => 12345,
                'fork_count' => 1337,
                'stargazers_count' => 1337
            ]))
        ]);

        $gitHubClient = new GitHubClient('NOT_A_REAL_TOKEN', [
            'handler' => HandlerStack::create($mock)
        ]);

        $repository = $gitHubClient->repository('fprefect', 'hhgttg');

        $this->assertObjectHasAttribute('fork_count', $repository);
        $this->assertObjectHasAttribute('stargazers_count', $repository);
    }

    public function test_it_returns_an_empty_object_when_it_fails_to_retrieve_repository_details()
    {
        $mock = new MockHandler([
            new ClientException('Not found', new Request('GET', 'test'))
        ]);

        $gitHubClient = new GitHubClient('NOT_A_REAL_TOKEN', [
            'handler' => HandlerStack::create($mock)
        ]);

        $repository = $gitHubClient->repository('adent', 'another_thing');

        $this->assertIsObject($repository);
        $this->assertEmpty((array) $repository);
    }

    public function test_it_can_cache_repository_details()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                'id' => 12345,
                'fork_count' => 1337,
                'stargazers_count' => 1337
            ])),
            new Response(200, [], json_encode([
                'id' => 54321,
                'fork_count' => 7331,
                'stargazers_count' => 7331
            ])),
        ]);

        $gitHubClient = new CachedGitHubClient('NOT_A_REAL_TOKEN', [
            'handler' => HandlerStack::create($mock)
        ]);

        $repository = $gitHubClient->repository('fprefect', 'hhgttg');
        $repository2 = $gitHubClient->repository('fprefect', 'hhgttg');

        $this->assertEquals(1337, $repository->fork_count);
        $this->assertEquals(1337, $repository->stargazers_count);
        $this->assertEquals(1337, $repository2->fork_count);
        $this->assertEquals(1337, $repository2->stargazers_count);
    }
}
