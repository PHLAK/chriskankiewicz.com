<?php

use App\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /** @var array Array of Pokemon */
    protected $experiences = [
        ['PetSmart Store Support Group', 'Solution Center Technician', '', '2008-02-01', '2009-03-01', false, 'Phoenix, Arizona'],
        ['Southwest Medical & Rehab', 'Web Developer / Designer', '', '2009-03-01', '2011-04-01', false, 'Phoenix, Arizona'],
        ['Arizona State University', 'Web Application Developer', '', '2011-04-01', '2014-06-01', false, 'Phoenix, Arizona'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $experiences = collect($this->experiences)->map(function ($experience) {
            return array_combine([
                'company', 'position', 'description', 'start_date', 'end_date', 'current_position', 'location'
            ], $experience);
        });

        Experience::insert($experiences->toArray());
    }
}
