<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Education;
use App\User;

class EducationTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_list_all_education()
    {
        factory(Education::class, 3)->create();

        $response = $this->json('GET', route('education.index'));

        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonStructure([
                ['institution', 'degree', 'start_date', 'end_date', 'currently_enrolled']
            ]);
    }

    public function test_it_can_get_an_individual_education()
    {
        factory(Education::class)->create();
        $education = factory(Education::class)->create();
        factory(Education::class)->create();

        $response = $this->json('GET', route('education.show', ['id' => $education]));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'institution', 'degree', 'start_date', 'end_date', 'currently_enrolled'
            ]);
    }

    public function test_it_can_create_a_new_education()
    {
        $user = factory(User::class)->create(['is_admin' => true]);

        $response = $this->actingAs($user, 'api')
            ->json('POST', route('education.store'), [
                'institution' => 'Hogwarts School of Witchcraft and Wizardry',
                'degree' => 'Care of Magical Creatures',
                'start_date' => '1986-05-20',
                'currently_enrolled' => true
            ]);

        $response->assertStatus(201)
            ->assertJson([
                'institution' => 'Hogwarts School of Witchcraft and Wizardry',
                'degree' => 'Care of Magical Creatures',
                'start_date' => '1986-05-20 00:00:00',
                'currently_enrolled' => true
            ]);
    }

    public function test_it_can_update_an_education()
    {
        $user = factory(User::class)->create(['is_admin' => true]);
        $education = factory(Education::class)->create();

        $response = $this->actingAs($user, 'api')
            ->json('PATCH', route('education.update', ['id' => $education]), [
                'end_date' => '1986-07-06',
                'currently_enrolled' => false
            ]);

        $response->assertStatus(200)
            ->assertJson([
                'end_date' => '1986-07-06 00:00:00',
                'currently_enrolled' => false
            ]);

        $this->assertDatabaseHas('education', [
            'id' => $education->id,
            'end_date' => '1986-07-06 00:00:00',
            'currently_enrolled' => false
        ]);
    }

    public function test_it_can_delete_an_education()
    {
        $user = factory(User::class)->create(['is_admin' => true]);
        factory(Education::class)->create();
        $education = factory(Education::class)->create();
        factory(Education::class)->create();

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', route('education.destroy', ['id' => $education]));

        $response->assertStatus(204);
        $this->assertSoftDeleted('education', [
            'id' => $education->id
        ]);
    }
}
