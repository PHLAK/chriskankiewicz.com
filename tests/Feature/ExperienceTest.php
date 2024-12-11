<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExperienceTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_access_the_experience_page(): void
    {
        $response = $this->get(route('experience'));

        $response->assertOk()->assertViewIs('experience');
    }
}
