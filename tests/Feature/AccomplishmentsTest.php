<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccomplishmentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_access_the_accomplishments_page(): void
    {
        $response = $this->get(route('accomplishments'));

        $response->assertOk()->assertViewIs('accomplishments');
    }
}
