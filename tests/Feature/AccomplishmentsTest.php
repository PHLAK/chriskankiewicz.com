<?php

namespace Tests\Feature;

use App\Http\Controllers\AccomplishmentsController;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(AccomplishmentsController::class)]
class AccomplishmentsTest extends TestCase
{
    #[Test]
    public function it_can_access_the_accomplishments_page(): void
    {
        $response = $this->get(route('accomplishments'));

        $response->assertOk()->assertViewIs('accomplishments');
    }
}
