<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EducationTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_access_the_education_page(): void
    {
        $response = $this->get(route('education'));

        $response->assertOk()->assertViewIs('education');
    }
}
