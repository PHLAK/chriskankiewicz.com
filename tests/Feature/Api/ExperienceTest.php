<?php

namespace Tests\Feature\Api;

use App\Experience;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExperienceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_all_experiences()
    {
        Experience::factory()->count(3)->create();

        $response = $this->json('GET', route('experience.index'));

        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonStructure([
                ['company', 'title', 'description', 'start_date', 'end_date'],
            ]);
    }

    /** @test */
    public function it_can_get_an_individual_experience()
    {
        Experience::factory()->create();
        $experience = Experience::factory()->create();
        Experience::factory()->create();

        $response = $this->json('GET', route('experience.show', ['experience' => $experience]));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'company', 'title', 'description', 'start_date', 'end_date',
            ]);
    }

    /** @test */
    public function it_can_create_a_new_experience()
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user, 'api')
            ->json('POST', route('experience.store'), [
                'company' => 'Pied Piper',
                'title' => 'Data Janitor',
                'description' => 'Pushed bits around.',
                'start_date' => '1986-05-20',
                'location' => 'San Francisco, California',
            ]);

        $response->assertStatus(201)
            ->assertJson([
                'company' => 'Pied Piper',
                'title' => 'Data Janitor',
                'description' => 'Pushed bits around.',
                'start_date' => '1986-05-20T00:00:00.000000Z',
                'location' => 'San Francisco, California',
            ]);
    }

    /** @test */
    public function it_can_update_an_experience()
    {
        $user = User::factory()->admin()->create();
        $experience = Experience::factory()->create();

        $response = $this->actingAs($user, 'api')
            ->json('PATCH', route('experience.update', ['experience' => $experience]), [
                'company' => 'Pied Piper',
                'title' => 'Data Janitor',
                'description' => 'Pushed bits around.',
                'start_date' => '1986-05-20',
                'location' => 'San Francisco, California',
            ]);

        $response->assertStatus(200)->assertJson([
            'company' => 'Pied Piper',
            'title' => 'Data Janitor',
            'description' => 'Pushed bits around.',
            'start_date' => '1986-05-20T00:00:00.000000Z',
            'location' => 'San Francisco, California',
        ]);

        $this->assertDatabaseHas('experiences', [
            'id' => $experience->id,
            'company' => 'Pied Piper',
            'title' => 'Data Janitor',
            'description' => 'Pushed bits around.',
            'start_date' => '1986-05-20 00:00:00',
            'location' => 'San Francisco, California',
        ]);
    }

    /** @test */
    public function it_can_delete_an_experience()
    {
        $user = User::factory()->admin()->create();
        Experience::factory()->create();
        $experience = Experience::factory()->create();
        Experience::factory()->create();

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', route('experience.destroy', ['experience' => $experience]));

        $response->assertStatus(204);
        $this->assertSoftDeleted('experiences', [
            'id' => $experience->id,
        ]);
    }
}
