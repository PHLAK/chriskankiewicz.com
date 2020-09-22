<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_access_the_home_page(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk()->assertViewIs('home');
    }
}
