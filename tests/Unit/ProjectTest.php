<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Project;
use Illuminate\Support\Carbon;

class ProjectTest extends TestCase
{
    public function test_it_can_instantiate_an_project()
    {
        $project = new Project();

        $this->assertInstanceOf(Project::class, $project);
    }
}
