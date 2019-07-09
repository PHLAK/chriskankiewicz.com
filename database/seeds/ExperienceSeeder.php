<?php

use Illuminate\Database\Seeder;
use Symfony\Component\Yaml\Yaml;
use App\Experience;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Experience::insert(
            Yaml::parseFile(database_path('seeds/data/experience.yaml'))
        );
    }
}
