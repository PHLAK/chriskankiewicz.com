<?php

namespace Tests\Unit;

use App\Skill;
use Tests\TestCase;

class SkillTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_instantiate_a_skill(): void
    {
        $skill = new Skill;

        $this->assertInstanceOf(Skill::class, $skill);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_get_a_skills_name(): void
    {
        $skill = new Skill(['name' => 'Lockpicking']);

        $this->assertEquals('Lockpicking', $skill->name);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_get_a_skills_icon_styles(): void
    {
        $skill = new Skill([
            'icon_name' => 'coffee',
            'icon_style' => 'fas',
        ]);

        $this->assertEquals('coffee', $skill->icon_name);
        $this->assertEquals('fas', $skill->icon_style);
        $this->assertEquals('fas fa-coffee', $skill->iconStyles());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_get_a_skills_icon_styles_with_extra_classes(): void
    {
        $skill = new Skill([
            'icon_name' => 'coffee',
            'icon_style' => 'fas',
        ]);

        $this->assertEquals('fas fa-coffee fa-fw', $skill->iconStyles(['fa-fw']));
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_get_a_skills_icon_markup(): void
    {
        $skill = new Skill([
            'icon_name' => 'coffee',
            'icon_style' => 'fas',
        ]);

        $this->assertEquals('<i class="fas fa-coffee"></i>', $skill->iconMarkup());
        $this->assertEquals('<i class="fas fa-coffee fa-fw"></i>', $skill->iconMarkup(['fa-fw']));
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_determine_if_a_skill_has_an_icon(): void
    {
        $skill = new Skill([
            'icon_name' => 'coffee',
            'icon_style' => 'fas',
        ]);

        $this->assertTrue($skill->hasIcon());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_determine_if_a_skill_does_not_have_an_icon(): void
    {
        $skill1 = new Skill;
        $skill2 = new Skill(['icon_name' => 'coffee']);
        $skill3 = new Skill(['icon_style' => 'fas']);

        $this->assertFalse($skill1->hasIcon());
        $this->assertFalse($skill2->hasIcon());
        $this->assertFalse($skill3->hasIcon());
    }
}
