<?php

namespace Tests\Feature;

use Tests\TestCase;

class EducationTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_access_the_education_page(): void
    {
        $response = $this->get(route('education'));

        $response->assertOk()->assertViewIs('education');
    }
}
