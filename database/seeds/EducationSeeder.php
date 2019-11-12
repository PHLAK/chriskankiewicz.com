<?php

use App\Education;
use Illuminate\Database\Seeder;
use Symfony\Component\Yaml\Yaml;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Education::insert(
            Yaml::parseFile(database_path('seeds/data/education.yaml'))
        );
    }
}
