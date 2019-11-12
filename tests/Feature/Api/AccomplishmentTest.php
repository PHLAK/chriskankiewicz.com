<?php

namespace Tests\Feature\Api;

use App\Accomplishment;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccomplishmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_list_all_accomplishment()
    {
        factory(Accomplishment::class, 3)->create();

        $response = $this->json('GET', route('accomplishment.index'));

        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonStructure([
                ['description']
            ]);
    }

    public function test_it_can_get_an_individual_accomplishment()
    {
        factory(Accomplishment::class)->create();
        $accomplishment = factory(Accomplishment::class)->create();
        factory(Accomplishment::class)->create();

        $response = $this->json('GET', route('accomplishment.show', [
            'accomplishment' => $accomplishment
        ]));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'description'
            ]);
    }

    public function test_it_can_create_a_new_accomplishment()
    {
        $user = factory(User::class)->states('is_admin')->create();

        $response = $this->actingAs($user, 'api')
            ->json('POST', route('accomplishment.store'), [
                'description' => 'Father of Kaylee.'
            ]);

        $response->assertStatus(201)
            ->assertJson([
                'description' => 'Father of Kaylee.'
            ]);
    }

    public function test_it_can_update_an_accomplishment()
    {
        $user = factory(User::class)->states('is_admin')->create();
        $accomplishment = factory(Accomplishment::class)->create();

        $response = $this->actingAs($user, 'api')
            ->json('PATCH', route('accomplishment.update', ['accomplishment' => $accomplishment]), [
                'description' => 'Father of Kaylee and Victor.'
            ]);

        $response->assertStatus(200)
            ->assertJson([
                'description' => 'Father of Kaylee and Victor.'
            ]);

        $this->assertDatabaseHas('accomplishments', [
            'id' => $accomplishment->id,
            'description' => 'Father of Kaylee and Victor.'
        ]);
    }

    public function test_it_can_delete_an_accomplishment()
    {
        $user = factory(User::class)->states('is_admin')->create();
        factory(Accomplishment::class)->create();
        $accomplishment = factory(Accomplishment::class)->create();
        factory(Accomplishment::class)->create();

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', route('accomplishment.destroy', ['accomplishment' => $accomplishment]));

        $response->assertStatus(204);
        $this->assertSoftDeleted('accomplishments', [
            'id' => $accomplishment->id
        ]);
    }
}
