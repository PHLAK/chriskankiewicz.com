<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_see_the_dashboard_when_logged_in()
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertSee('You are logged in!');
    }
}
