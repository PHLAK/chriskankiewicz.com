<?php

use App\Skill;
use Illuminate\Database\Seeder;
use Symfony\Component\Yaml\Yaml;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skill::insert(
            Yaml::parseFile(database_path('seeds/data/skills.yaml'))
        );
    }
}
