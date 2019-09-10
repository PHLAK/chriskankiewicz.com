<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Project;
use App\User;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_list_all_projects()
    {
        factory(Project::class, 3)->create();

        $response = $this->json('GET', route('project.index'));

        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonStructure([
                ['name', 'description', 'project_url', 'source_url']
            ]);
    }

    public function test_it_can_get_an_individual_project()
    {
        factory(Project::class)->create();
        $project = factory(Project::class)->create();
        factory(Project::class)->create();

        $response = $this->json('GET', route('project.show', ['project' => $project]));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'name', 'description', 'project_url', 'source_url'
            ]);
    }

    public function test_it_can_create_a_new_project()
    {
        $user = factory(User::class)->states('is_admin')->create();

        $response = $this->actingAs($user, 'api')
            ->json('POST', route('project.store'), [
                'name' => 'Death Star',
                'description' => "That's no moon",
                'project_url' => 'https://en.wikipedia.org/wiki/Death_Star',
                'source_url' => 'https://github.com/PHLAK/death-star'
            ]);

        $response->assertStatus(201)
            ->assertJson([
                'name' => 'Death Star',
                'description' => "That's no moon",
                'project_url' => 'https://en.wikipedia.org/wiki/Death_Star',
                'source_url' => 'https://github.com/PHLAK/death-star'
            ]);
    }

    public function test_it_can_update_an_project()
    {
        $user = factory(User::class)->states('is_admin')->create();
        $project = factory(Project::class)->create();

        $response = $this->actingAs($user, 'api')
            ->json('PATCH', route('project.update', ['project' => $project]), [
                'name' => 'Death Star 2'
            ]);

        $response->assertStatus(200)
            ->assertJson([
                'name' => 'Death Star 2'
            ]);

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'name' => 'Death Star 2'
        ]);
    }

    public function test_it_can_delete_an_project()
    {
        $user = factory(User::class)->states('is_admin')->create();
        factory(Project::class)->create();
        $project = factory(Project::class)->create();
        factory(Project::class)->create();

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', route('project.destroy', ['project' => $project]));

        $response->assertStatus(204);
        $this->assertSoftDeleted('projects', [
            'id' => $project->id
        ]);
    }
}
