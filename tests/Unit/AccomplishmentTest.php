<?php

namespace Tests\Unit;

use App\Accomplishment;
use Tests\TestCase;

class AccomplishmentTest extends TestCase
{
    public function test_it_can_instantiate_an_accomplishment()
    {
        $accomplishment = new Accomplishment();

        $this->assertInstanceOf(Accomplishment::class, $accomplishment);
    }
}
