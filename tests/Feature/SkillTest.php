<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Skill;

class SkillTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_list_all_skills()
    {
        factory(Skill::class, 3)->create();

        $response = $this->json('GET', route('skill.index'));

        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonStructure([
                ['name']
            ]);
    }

    public function test_it_can_get_an_individual_skill()
    {
        factory(Skill::class)->create();
        $skill = factory(Skill::class)->create();
        factory(Skill::class)->create();

        $response = $this->json('GET', route('skill.show', ['id' => $skill]));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'name'
            ]);
    }

    public function test_it_can_create_a_new_skill()
    {
        $response = $this->json('POST', route('skill.store'), [
            'name' => 'Lockpicking'
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'name' => 'Lockpicking'
            ]);
    }

    public function test_it_can_update_an_skill()
    {
        $skill = factory(Skill::class)->create();

        $response = $this->json('PATCH', route('skill.update', ['id' => $skill]), [
            'name' => 'Pickpocketing'
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'name' => 'Pickpocketing'
            ]);

        $this->assertDatabaseHas('skills', [
            'id' => $skill->id,
            'name' => 'Pickpocketing'
        ]);
    }

    public function test_it_can_delete_an_skill()
    {
        factory(Skill::class)->create();
        $skill = factory(Skill::class)->create();
        factory(Skill::class)->create();

        $response = $this->json('DELETE', route('skill.destroy', ['id' => $skill ]));

        $response->assertStatus(204);
        $this->assertSoftDeleted('skills', [
            'id' => $skill->id
        ]);
    }
}
