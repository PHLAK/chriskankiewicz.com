<?php

namespace Database\Seeders;

use App\Experience;
use App\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Symfony\Component\Yaml\Yaml;

class ExperienceSeeder extends Seeder
{
    /** Run the database seeds. */
    public function run(): void
    {
        $experiences = Yaml::parseFile(database_path('seeders/data/experience.yaml'));

        foreach ($experiences as $experience) {
            $experience = Collection::make($experience);

            if ($experience->has('skills')) {
                $skills = array_map(function ($skill) {
                    return Skill::firstOrCreate(['name' => $skill]);
                }, $experience->pull('skills'));
            } else {
                $skills = [];
            }

            $experience = Experience::create($experience->all());
            $experience->skills()->saveMany($skills);
        }
    }
}
