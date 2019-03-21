<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Education;
use Illuminate\Support\Carbon;

class EducationTest extends TestCase
{
    public function test_it_can_instantiate_an_education()
    {
        $education = new Education();

        $this->assertInstanceOf(Education::class, $education);
    }

    public function test_it_casts_currently_enrolled_to_a_boolean()
    {
        $education = new Education([
            'currently_enrolled' => 1
        ]);

        $this->assertTrue($education->currently_enrolled);
    }

    public function test_it_casts_start_and_end_dates_to_carbon_instances()
    {
        $education = new Education([
            'start_date' => '1986-05-20',
            'end_date' => '1986-07-06'
        ]);

        $this->assertInstanceOf(Carbon::class, $education->start_date);
        $this->assertInstanceOf(Carbon::class, $education->end_date);
    }
}
