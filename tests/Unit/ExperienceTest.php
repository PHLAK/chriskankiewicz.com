<?php

namespace Tests\Unit;

use App\Experience;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(Experience::class)]
class ExperienceTest extends TestCase
{
    #[Test]
    public function it_can_instantiate_an_experience(): void
    {
        $experience = new Experience;

        $this->assertInstanceOf(Experience::class, $experience);
    }

    #[Test]
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
