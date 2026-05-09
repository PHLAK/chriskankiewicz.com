<?php

namespace Tests\Feature;

use App\Http\Controllers\EducationController;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(EducationController::class)]
class EducationTest extends TestCase
{
    #[Test]
    public function it_can_access_the_education_page(): void
    {
        $response = $this->get(route('education'));

        $response->assertOk()->assertViewIs('education');
    }
}
