<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Symfony\Component\Yaml\Yaml;
use App\Experience;
use App\Skill;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $experiences = Yaml::parseFile(database_path('seeds/data/experience.yaml'));

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
