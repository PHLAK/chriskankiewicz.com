<?php

namespace Tests\Unit;

use App\Education;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class EducationTest extends TestCase
{
    /** @test */
    public function it_can_instantiate_an_education()
    {
        $education = new Education();

        $this->assertInstanceOf(Education::class, $education);
    }

    /** @test */
    public function it_casts_start_and_end_dates_to_carbon_instances()
    {
        $education = new Education([
            'start_date' => '1986-05-20',
            'end_date' => '1986-07-06',
        ]);

        $this->assertInstanceOf(Carbon::class, $education->start_date);
        $this->assertInstanceOf(Carbon::class, $education->end_date);
    }
}
