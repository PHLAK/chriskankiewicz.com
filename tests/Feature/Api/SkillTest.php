<?php

namespace Tests\Feature\Api;

use App\Skill;
use App\User;
use Kirschbaum\OpenApiValidator\ValidatesOpenApiSpec;
use Tests\TestCase;

class SkillTest extends TestCase
{
    use ValidatesOpenApiSpec;

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_list_all_skills(): void
    {
        Skill::factory()->count(3)->create();

        $response = $this->json('GET', route('skill.index'));

        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonStructure([
                ['name', 'icon_name', 'icon_style'],
            ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_get_an_individual_skill(): void
    {
        Skill::factory()->create();
        $skill = Skill::factory()->create();
        Skill::factory()->create();

        $response = $this->json('GET', route('skill.show', ['skill' => $skill]));

        $response->assertStatus(200)->assertJsonStructure(['name', 'icon_name', 'icon_style']);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_create_a_new_skill(): void
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user, 'api')
            ->json('POST', route('skill.store'), [
                'name' => 'Lockpicking',
            ]);

        $response->assertStatus(201)
            ->assertJson([
                'name' => 'Lockpicking',
            ]);

        $this->assertDatabaseHas('skills', [
            'name' => 'Lockpicking',
            'icon_name' => null,
            'icon_style' => null,
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_update_a_skill(): void
    {
        $user = User::factory()->admin()->create();
        $skill = Skill::factory()->create();

        $response = $this->actingAs($user, 'api')
            ->json('PATCH', route('skill.update', ['skill' => $skill]), [
                'name' => 'Pickpocketing',
            ]);

        $response->assertStatus(200)
            ->assertJson([
                'name' => 'Pickpocketing',
            ]);

        $this->assertDatabaseHas('skills', [
            'id' => $skill->id,
            'name' => 'Pickpocketing',
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_delete_a_skill(): void
    {
        $user = User::factory()->admin()->create();

        Skill::factory()->create();
        $skill = Skill::factory()->create();
        Skill::factory()->create();

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', route('skill.destroy', ['skill' => $skill]));

        $response->assertStatus(204);
        $this->assertSoftDeleted('skills', [
            'id' => $skill->id,
        ]);
    }
}
