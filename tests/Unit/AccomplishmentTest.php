<?php

namespace Tests\Unit;

use App\Accomplishment;
use Tests\TestCase;

class AccomplishmentTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_instantiate_an_accomplishment(): void
    {
        $accomplishment = new Accomplishment;

        $this->assertInstanceOf(Accomplishment::class, $accomplishment);
    }
}
