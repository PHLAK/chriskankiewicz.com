<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Skill;

class SkillTest extends TestCase
{
    public function test_it_can_instantiate_an_project()
    {
        $project = new Skill();

        $this->assertInstanceOf(Skill::class, $project);
    }

    public function test_it_can_get_default_icon_styles()
    {
        $skill = new Skill();

        $this->assertEquals('text-gray-800 text-base', $skill->styles());
    }

    public function test_it_can_get_emphasized_icon_styles()
    {
        $skill = new Skill([
            'emphasis' => 1
        ]);

        $this->assertEquals('text-gray-900 text-xl', $skill->styles());
    }

    public function test_it_can_get_deemphasized_icon_styles()
    {
        $skill = new Skill([
            'emphasis' => -1
        ]);

        $this->assertEquals('text-gray-700 text-xs', $skill->styles());
    }
}
