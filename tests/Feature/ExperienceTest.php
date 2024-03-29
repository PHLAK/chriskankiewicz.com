<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExperienceTest extends TestCase
{
    /** @test */
    public function it_can_access_the_experience_page(): void
    {
        $response = $this->get(route('experience'));

        $response->assertOk()->assertViewIs('experience');
    }
}
