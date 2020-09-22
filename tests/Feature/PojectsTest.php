<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PojectsTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_access_the_projects_page(): void
    {
        $response = $this->get(route('projects'));

        $response->assertOk()->assertViewIs('projects');
    }
}
