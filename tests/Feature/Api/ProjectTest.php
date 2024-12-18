<?php

namespace Tests\Feature\Api;

use App\Project;
use App\User;
use Kirschbaum\OpenApiValidator\ValidatesOpenApiSpec;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use ValidatesOpenApiSpec;

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_list_all_projects(): void
    {
        Project::factory()->count(3)->create();

        $response = $this->json('GET', route('project.index'));

        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonStructure([
                ['name', 'description', 'project_url', 'source_url'],
            ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_get_an_individual_project(): void
    {
        Project::factory()->create();
        $project = Project::factory()->create();
        Project::factory()->create();

        $response = $this->json('GET', route('project.show', ['project' => $project]));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'name', 'description', 'project_url', 'source_url',
            ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_create_a_new_project(): void
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user, 'api')
            ->json('POST', route('project.store'), [
                'name' => 'Death Star',
                'description' => "That's no moon",
                'project_url' => 'https://en.wikipedia.org/wiki/Death_Star',
                'source_url' => 'https://github.com/PHLAK/death-star',
            ]);

        $response->assertStatus(201)
            ->assertJson([
                'name' => 'Death Star',
                'description' => "That's no moon",
                'project_url' => 'https://en.wikipedia.org/wiki/Death_Star',
                'source_url' => 'https://github.com/PHLAK/death-star',
            ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_update_an_project(): void
    {
        $user = User::factory()->admin()->create();
        $project = Project::factory()->create();

        $response = $this->actingAs($user, 'api')
            ->json('PATCH', route('project.update', ['project' => $project]), [
                'name' => 'Death Star 2',
            ]);

        $response->assertStatus(200)
            ->assertJson([
                'name' => 'Death Star 2',
            ]);

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'name' => 'Death Star 2',
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_delete_an_project(): void
    {
        $user = User::factory()->admin()->create();
        Project::factory()->create();
        $project = Project::factory()->create();
        Project::factory()->create();

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', route('project.destroy', ['project' => $project]));

        $response->assertStatus(204);
        $this->assertSoftDeleted('projects', [
            'id' => $project->id,
        ]);
    }
}
