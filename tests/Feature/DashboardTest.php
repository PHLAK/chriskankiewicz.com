<?php

namespace Tests\Feature;

use App\Http\Controllers\DashboardController;
use App\User;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(DashboardController::class)]
class DashboardTest extends TestCase
{
    #[Test]
    public function it_can_see_the_dashboard_when_logged_in(): void
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertSee('You are logged in!');
    }
}
