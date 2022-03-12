<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    /** @test */
    public function it_can_see_the_dashboard_when_logged_in(): void
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertSee('You are logged in!');
    }
}
