<?php

namespace Tests\Feature;

use Tests\TestCase;

class PojectsTest extends TestCase
{
    /** @test */
    public function it_can_access_the_projects_page(): void
    {
        $response = $this->get(route('projects'));

        $response->assertOk()->assertViewIs('projects');
    }
}
