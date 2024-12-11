<?php

namespace Tests\Unit;

use App\Experience;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class ExperienceTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_instantiate_an_experience(): void
    {
        $experience = new Experience;

        $this->assertInstanceOf(Experience::class, $experience);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_casts_start_and_end_dates_to_carbon_instances(): void
    {
        $experience = new Experience([
            'start_date' => '1986-05-20',
            'end_date' => '1986-07-06',
        ]);

        $this->assertInstanceOf(Carbon::class, $experience->start_date);
        $this->assertInstanceOf(Carbon::class, $experience->end_date);
    }
}
