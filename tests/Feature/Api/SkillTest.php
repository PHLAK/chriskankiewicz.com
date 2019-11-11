<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Skill;
use App\User;

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
                ['name', 'icon_name', 'icon_style']
            ]);
    }

    public function test_it_can_get_an_individual_skill()
    {
        factory(Skill::class)->create();
        $skill = factory(Skill::class)->create();
        factory(Skill::class)->create();

        $response = $this->json('GET', route('skill.show', ['skill' => $skill]));

        $response->assertStatus(200)->assertJsonStructure(['name', 'icon_name', 'icon_style']);
    }

    public function test_it_can_create_a_new_skill()
    {
        $user = factory(User::class)->states('is_admin')->create();

        $response = $this->actingAs($user, 'api')
            ->json('POST', route('skill.store'), [
                'name' => 'Lockpicking'
            ]);

        $response->assertStatus(201)
            ->assertJson([
                'name' => 'Lockpicking'
            ]);

        $this->assertDatabaseHas('skills', [
            'name' => 'Lockpicking',
            'icon_name' => null,
            'icon_style' => null
        ]);
    }

    public function test_it_can_update_a_skill()
    {
        $user = factory(User::class)->states('is_admin')->create();
        $skill = factory(Skill::class)->create();

        $response = $this->actingAs($user, 'api')
            ->json('PATCH', route('skill.update', ['skill' => $skill]), [
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

    public function test_it_can_delete_a_skill()
    {
        $user = factory(User::class)->states('is_admin')->create();

        factory(Skill::class)->create();
        $skill = factory(Skill::class)->create();
        factory(Skill::class)->create();

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', route('skill.destroy', ['skill' => $skill]));

        $response->assertStatus(204);
        $this->assertSoftDeleted('skills', [
            'id' => $skill->id
        ]);
    }
}
