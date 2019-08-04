<?php

use Illuminate\Database\Seeder;
use Symfony\Component\Yaml\Yaml;
use App\Accomplishment;

class AccomplishmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Accomplishment::insert(
            Yaml::parseFile(database_path('seeds/data/accomplishments.yaml'))
        );
    }
}
