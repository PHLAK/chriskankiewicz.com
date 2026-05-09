<?php

namespace Tests\Unit;

use App\Accomplishment;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(Accomplishment::class)]
class AccomplishmentTest extends TestCase
{
    #[Test]
    public function it_can_instantiate_an_accomplishment(): void
    {
        $accomplishment = new Accomplishment;

        $this->assertInstanceOf(Accomplishment::class, $accomplishment);
    }
}
