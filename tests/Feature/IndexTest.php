<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_see_the_home_page()
    {
        $response = $this->get(route('index'));

        $response
            ->assertSee('Chris Kankiewicz')
            ->assertSee('Experience')
            ->assertSee('Education')
            ->assertSee('Projects');
    }
}
