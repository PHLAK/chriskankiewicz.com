<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_not_acces_the_registration_page()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(404);
    }

    /** @test */
    public function it_can_acces_the_login_page()
    {
        $response = $this->get(route('login'));

        $response->assertOk();
    }

    /** @test */
    public function it_can_log_in()
    {
        $user = User::factory()->admin()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function it_redirects_to_the_dashboard_when_already_logged_in()
    {
        $user = User::factory()->admin()->make();

        $response = $this->actingAs($user)->get(route('login'));

        $response->assertRedirect(route('dashboard'));
    }
}
