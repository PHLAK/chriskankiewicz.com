<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExperienceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_access_the_experience_page(): void
    {
        $response = $this->get(route('experience'));

        $response->assertOk()->assertViewIs('experience');
    }
}
