<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SkillSeeder::class);
        $this->call(AccomplishmentSeeder::class);
        $this->call(EducationSeeder::class);
        $this->call(ExperienceSeeder::class);
        $this->call(ProjectSeeder::class);
    }
}
