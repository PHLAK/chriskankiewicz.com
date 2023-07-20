<?php

namespace Tests\Unit;

use App\GitHub\CachedClient as CachedGitHubClient;
use App\GitHub\Client as GitHubClient;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;

class GitHubClientTest extends TestCase
{
    /** @test */
    public function it_can_be_instantiated_from_the_service_container(): void
    {
        $gitHub = $this->app->make(GitHubClient::class);

        $this->assertInstanceOf(CachedGitHubClient::class, $gitHub);
    }

    /** @test */
    public function it_can_get_repository_details(): void
    {
        $gitHubClient = $this->mockGitHubClient([
            new Response(200, [], json_encode([
                'id' => 12345,
                'fork_count' => 1337,
                'stargazers_count' => 1337,
            ])),
        ]);

        $repository = $gitHubClient->repository('fprefect', 'hhgttg');

        $this->assertObjectHasProperty('fork_count', $repository);
        $this->assertObjectHasProperty('stargazers_count', $repository);
    }

    /** @test */
    public function it_returns_an_empty_object_when_it_fails_to_retrieve_repository_details(): void
    {
        $gitHubClient = $this->mockGitHubClient([
            new ClientException('Not found', new Request('GET', 'test'), new Response),
        ]);

        $repository = $gitHubClient->repository('adent', 'another_thing');

        $this->assertIsObject($repository);
        $this->assertEmpty((array) $repository);
    }

    /** @test */
    public function it_can_cache_repository_details(): void
    {
        $gitHubClient = $this->mockCachedGitHubClient([
            new Response(200, [], json_encode([
                'id' => 12345,
                'fork_count' => 1337,
                'stargazers_count' => 1337,
            ])),
            new Response(200, [], json_encode([
                'id' => 54321,
                'fork_count' => 7331,
                'stargazers_count' => 7331,
            ])),
        ]);

        $repository = $gitHubClient->repository('fprefect', 'hhgttg');
        $repository2 = $gitHubClient->repository('fprefect', 'hhgttg');

        $this->assertEquals(1337, $repository->fork_count);
        $this->assertEquals(1337, $repository->stargazers_count);
        $this->assertEquals(1337, $repository2->fork_count);
        $this->assertEquals(1337, $repository2->stargazers_count);
    }

    /** Get a mocked GitHub client. */
    private function mockGitHubClient(array $responses): GitHubClient
    {
        return new GitHubClient(new Client([
            'base_uri' => config('services.github.base_uri'),
            'headers' => [
                'Authorization' => 'Token NOT_A_REAL_TOKEN',
            ],
            'handler' => HandlerStack::create(new MockHandler($responses)),
        ]));
    }

    /** Get a mocked cached GitHub client. */
    private function mockCachedGitHubClient(array $responses): CachedGitHubClient
    {
        return new CachedGitHubClient($this->mockGitHubClient($responses));
    }
}
