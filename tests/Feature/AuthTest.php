<?php

namespace Tests\Feature;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\User;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(LoginController::class)]
#[CoversClass(RegisterController::class)]
class AuthTest extends TestCase
{
    #[Test]
    public function it_can_not_acces_the_registration_page(): void
    {
        $response = $this->get(route('register'));

        $response->assertStatus(404);
    }

    #[Test]
    public function it_can_acces_the_login_page(): void
    {
        $response = $this->get(route('login'));

        $response->assertOk();
    }

    #[Test]
    public function it_can_log_in(): void
    {
        $user = User::factory()->admin()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    #[Test]
    public function it_redirects_to_the_dashboard_when_already_logged_in(): void
    {
        $user = User::factory()->admin()->make();

        $response = $this->actingAs($user)->get(route('login'));

        $response->assertRedirect(route('dashboard'));
    }
}
