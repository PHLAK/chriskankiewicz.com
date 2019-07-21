<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_see_the_dashboard_when_logged_in()
    {
        $user = factory(User::class)->create(['is_admin' => true]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertSee('You are logged in!');
    }
}
