<?php

namespace Tests\Feature\Api;

use App\Education;
use App\User;
use Kirschbaum\OpenApiValidator\ValidatesOpenApiSpec;
use Tests\TestCase;

class EducationTest extends TestCase
{
    use ValidatesOpenApiSpec;

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_list_all_education(): void
    {
        Education::factory()->count(3)->create();

        $response = $this->json('GET', route('education.index'));

        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonStructure([
                ['institution', 'degree', 'start_date', 'end_date'],
            ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_get_an_individual_education(): void
    {
        Education::factory()->create();
        $education = Education::factory()->create();
        Education::factory()->create();

        $response = $this->json('GET', route('education.show', ['education' => $education]));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'institution', 'degree', 'start_date', 'end_date',
            ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_create_a_new_education(): void
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user, 'api')
            ->json('POST', route('education.store'), [
                'institution' => 'Hogwarts School of Witchcraft and Wizardry',
                'degree' => 'Care of Magical Creatures',
                'start_date' => '1986-05-20',
            ]);

        $response->assertStatus(201)
            ->assertJson([
                'institution' => 'Hogwarts School of Witchcraft and Wizardry',
                'degree' => 'Care of Magical Creatures',
                'start_date' => '1986-05-20T00:00:00.000000Z',
            ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_update_an_education(): void
    {
        $user = User::factory()->admin()->create();
        $education = Education::factory()->create();

        $response = $this->actingAs($user, 'api')
            ->json('PATCH', route('education.update', ['education' => $education]), [
                'institution' => 'Hogwarts School of Witchcraft and Wizardry',
                'degree' => 'Care of Magical Creatures',
                'start_date' => '1986-05-20',
                'end_date' => '1986-07-06',
            ]);

        $response->assertStatus(200)->assertJson([
            'institution' => 'Hogwarts School of Witchcraft and Wizardry',
            'degree' => 'Care of Magical Creatures',
            'start_date' => '1986-05-20T00:00:00.000000Z',
            'end_date' => '1986-07-06T00:00:00.000000Z',
        ]);

        $this->assertDatabaseHas('education', [
            'id' => $education->id,
            'institution' => 'Hogwarts School of Witchcraft and Wizardry',
            'degree' => 'Care of Magical Creatures',
            'start_date' => '1986-05-20 00:00:00',
            'end_date' => '1986-07-06 00:00:00',
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_delete_an_education(): void
    {
        $user = User::factory()->admin()->create();
        Education::factory()->create();
        $education = Education::factory()->create();
        Education::factory()->create();

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', route('education.destroy', ['education' => $education]));

        $response->assertStatus(204);
        $this->assertSoftDeleted('education', [
            'id' => $education->id,
        ]);
    }
}
