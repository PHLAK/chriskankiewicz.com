<?php

namespace Database\Seeders;

use App\Accomplishment;
use Illuminate\Database\Seeder;
use Symfony\Component\Yaml\Yaml;

class AccomplishmentSeeder extends Seeder
{
    /** Run the database seeds. */
    public function run(): void
    {
        Accomplishment::insert(
            Yaml::parseFile(database_path('seeders/data/accomplishments.yaml'))
        );
    }
}
