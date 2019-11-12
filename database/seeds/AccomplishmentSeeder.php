<?php

use App\Accomplishment;
use Illuminate\Database\Seeder;
use Symfony\Component\Yaml\Yaml;

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
