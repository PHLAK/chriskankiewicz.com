<?php

namespace Database\Seeders;

use App\Skill;
use Illuminate\Database\Seeder;
use Symfony\Component\Yaml\Yaml;

class SkillSeeder extends Seeder
{
    /** Run the database seeds. */
    public function run(): void
    {
        Skill::insert(
            Yaml::parseFile(database_path('seeders/data/skills.yaml'))
        );
    }
}
