<?php

namespace Tests\Feature\Api;

use App\Education;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
                ['institution', 'degree', 'start_date', 'end_date']
            ]);
    }

    public function test_it_can_get_an_individual_education()
    {
        factory(Education::class)->create();
        $education = factory(Education::class)->create();
        factory(Education::class)->create();

        $response = $this->json('GET', route('education.show', ['education' => $education]));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'institution', 'degree', 'start_date', 'end_date'
            ]);
    }

    public function test_it_can_create_a_new_education()
    {
        $user = factory(User::class)->states('is_admin')->create();

        $response = $this->actingAs($user, 'api')
            ->json('POST', route('education.store'), [
                'institution' => 'Hogwarts School of Witchcraft and Wizardry',
                'degree' => 'Care of Magical Creatures',
                'start_date' => '1986-05-20'
            ]);

        $response->assertStatus(201)
            ->assertJson([
                'institution' => 'Hogwarts School of Witchcraft and Wizardry',
                'degree' => 'Care of Magical Creatures',
                'start_date' => '1986-05-20T00:00:00.000000Z'
            ]);
    }

    public function test_it_can_update_an_education()
    {
        $user = factory(User::class)->states('is_admin')->create();
        $education = factory(Education::class)->create();

        $response = $this->actingAs($user, 'api')
            ->json('PATCH', route('education.update', ['education' => $education]), [
                'end_date' => '1986-07-06'
            ]);

        $response->assertStatus(200)
            ->assertJson(['end_date' => '1986-07-06T00:00:00.000000Z']);

        $this->assertDatabaseHas('education', [
            'id' => $education->id,
            'end_date' => '1986-07-06 00:00:00'
        ]);
    }

    public function test_it_can_delete_an_education()
    {
        $user = factory(User::class)->states('is_admin')->create();
        factory(Education::class)->create();
        $education = factory(Education::class)->create();
        factory(Education::class)->create();

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', route('education.destroy', ['education' => $education]));

        $response->assertStatus(204);
        $this->assertSoftDeleted('education', [
            'id' => $education->id
        ]);
    }
}
