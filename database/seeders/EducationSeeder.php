<?php

namespace Database\Seeders;

use App\Education;
use Illuminate\Database\Seeder;
use Symfony\Component\Yaml\Yaml;

class EducationSeeder extends Seeder
{
    /** Run the database seeds. */
    public function run()
    {
        Education::insert(
            Yaml::parseFile(database_path('seeders/data/education.yaml'))
        );
    }
}
