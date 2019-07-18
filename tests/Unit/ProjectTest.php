<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Project;

class ProjectTest extends TestCase
{
    public function test_it_can_instantiate_an_project()
    {
        $project = new Project();

        $this->assertInstanceOf(Project::class, $project);
    }

    public function test_it_can_get_the_projects_github_project_id()
    {
        $project = new Project([
            'source_url' => 'https://github.com/fprefect/hhgttg'
        ]);

        $this->assertEquals('fprefect/hhgttg', $project->github_project_id);
    }

    public function test_it_can_get_the_projects_fork_count()
    {
        $project = new Project([
            'source_url' => 'https://github.com/fprefect/hhgttg'
        ]);

        $this->mockGitHubClient(function ($gitHubClient) {
            $gitHubClient->shouldReceive('repository')->andReturn((object) [
                'forks_count' => 1337
            ]);
        });

        $this->assertEquals(1337, $project->forks());
    }

    public function test_it_can_get_the_projects_star_count()
    {
        $project = new Project([
            'source_url' => 'https://github.com/fprefect/hhgttg'
        ]);

        $this->mockGitHubClient(function ($gitHubClient) {
            $gitHubClient->shouldReceive('repository')->andReturn((object) [
                'stargazers_count' => 1337
            ]);
        });

        $this->assertEquals(1337, $project->stars());
    }
}
