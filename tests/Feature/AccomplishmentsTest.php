<?php

namespace Tests\Feature;

use Tests\TestCase;

class AccomplishmentsTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_access_the_accomplishments_page(): void
    {
        $response = $this->get(route('accomplishments'));

        $response->assertOk()->assertViewIs('accomplishments');
    }
}
