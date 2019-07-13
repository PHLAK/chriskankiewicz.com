<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Experience;
use App\User;

class ExperienceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_list_all_experiences()
    {
        factory(Experience::class, 3)->create();

        $response = $this->json('GET', route('experience.index'));

        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonStructure([
                ['company', 'title', 'description', 'start_date', 'end_date', 'current_position']
            ]);
    }

    public function test_it_can_get_an_individual_experience()
    {
        factory(Experience::class)->create();
        $experience = factory(Experience::class)->create();
        factory(Experience::class)->create();

        $response = $this->json('GET', route('experience.show', ['id' => $experience]));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'company', 'title', 'description', 'start_date', 'end_date', 'current_position'
            ]);
    }

    public function test_it_can_create_a_new_experience()
    {
        $user = factory(User::class)->create(['is_admin' => true]);

        $response = $this->actingAs($user, 'api')
            ->json('POST', route('experience.store'), [
                'company' => 'Pied Piper',
                'title' => 'Data Janitor',
                'description' => 'Pushed bits around.',
                'start_date' => '1986-05-20 ',
                'current_position' => true,
                'location' => 'San Francisco, California'
            ]);

        $response->assertStatus(201)
            ->assertJson([
                'company' => 'Pied Piper',
                'title' => 'Data Janitor',
                'description' => 'Pushed bits around.',
                'start_date' => '1986-05-20 00:00:00',
                'current_position' => true,
                'location' => 'San Francisco, California'
            ]);
    }

    public function test_it_can_update_an_experience()
    {
        $user = factory(User::class)->create(['is_admin' => true]);
        $experience = factory(Experience::class)->create();

        $response = $this->actingAs($user, 'api')
            ->json('PATCH', route('experience.update', ['id' => $experience]), [
                'company' => 'Pied Piper'
            ]);

        $response->assertStatus(200)
            ->assertJson([
                'company' => 'Pied Piper'
            ]);

        $this->assertDatabaseHas('experiences', [
            'id' => $experience->id,
            'company' => 'Pied Piper'
        ]);
    }

    public function test_it_can_delete_an_experience()
    {
        $user = factory(User::class)->create(['is_admin' => true]);
        factory(Experience::class)->create();
        $experience = factory(Experience::class)->create();
        factory(Experience::class)->create();

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', route('experience.destroy', ['id' => $experience]));

        $response->assertStatus(204);
        $this->assertSoftDeleted('experiences', [
            'id' => $experience->id
        ]);
    }
}
