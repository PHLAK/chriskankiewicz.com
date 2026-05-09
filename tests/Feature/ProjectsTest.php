<?php

namespace Tests\Feature;

use App\Http\Controllers\ProjectsController;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(ProjectsController::class)]
class ProjectsTest extends TestCase
{
    #[Test]
    public function it_can_access_the_projects_page(): void
    {
        $response = $this->get(route('projects'));

        $response->assertOk()->assertViewIs('projects');
    }
}
