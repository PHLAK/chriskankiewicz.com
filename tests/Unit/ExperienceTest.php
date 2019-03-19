<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Experience;
use Illuminate\Support\Carbon;

class ExperienceTest extends TestCase
{
    public function test_it_can_instantiate_an_experience()
    {
        $experience = new Experience();

        $this->assertInstanceOf(Experience::class, $experience);
    }

    public function test_it_casts_current_position_to_a_boolean()
    {
        $experience = new Experience([
            'current_position' => 1
        ]);

        $this->assertTrue($experience->current_position);
    }

    public function test_it_casts_start_and_end_dates_to_carbon_instances()
    {
        $experience = new Experience([
            'start_date' => '1986-05-20',
            'end_date' => '1986-07-06'
        ]);

        $this->assertInstanceOf(Carbon::class, $experience->start_date);
        $this->assertInstanceOf(Carbon::class, $experience->end_date);
    }
}
