<?php

namespace Tests\Feature;

use App\Http\Controllers\ExperienceController;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(ExperienceController::class)]
class ExperienceTest extends TestCase
{
    #[Test]
    public function it_can_access_the_experience_page(): void
    {
        $response = $this->get(route('experience'));

        $response->assertOk()->assertViewIs('experience');
    }
}
