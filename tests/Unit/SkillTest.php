<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Skill;
use Illuminate\Support\Carbon;

class SkillTest extends TestCase
{
    public function test_it_can_instantiate_an_project()
    {
        $project = new Skill();

        $this->assertInstanceOf(Skill::class, $project);
    }
}
