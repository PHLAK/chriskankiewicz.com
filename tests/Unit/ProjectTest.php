<?php

namespace Tests\Unit;

use App\GitHub\Client as GitHubClient;
use App\Project;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(Project::class)]
class ProjectTest extends TestCase
{
    #[Test]
    public function it_can_instantiate_an_project(): void
    {
        $project = new Project;

        $this->assertInstanceOf(Project::class, $project);
    }

    #[Test]
    public function it_can_get_the_projects_github_project_id(): void
    {
        $project = new Project([
            'source_url' => 'https://github.com/fprefect/hhgttg',
        ]);

        $this->assertEquals('fprefect/hhgttg', $project->github_project_id);
    }

    #[Test]
    public function it_can_get_the_projects_fork_count(): void
    {
        $project = new Project([
            'source_url' => 'https://github.com/fprefect/hhgttg',
        ]);

        $this->mock(GitHubClient::class, function ($gitHubClient) {
            $gitHubClient->shouldReceive('repository')->andReturn((object) [
                'forks_count' => 1337,
            ]);
        });

        $this->assertEquals(1337, $project->forks());
    }

    #[Test]
    public function it_can_get_the_projects_star_count(): void
    {
        $project = new Project([
            'source_url' => 'https://github.com/fprefect/hhgttg',
        ]);

        $this->mock(GitHubClient::class, function ($gitHubClient) {
            $gitHubClient->shouldReceive('repository')->andReturn((object) [
                'stargazers_count' => 1337,
            ]);
        });

        $this->assertEquals(1337, $project->stars());
    }
}
