<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_see_the_dashboard_when_logged_in()
    {
        $user = factory(User::class)->states('is_admin')->create();

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertSee('You are logged in!');
    }
}
