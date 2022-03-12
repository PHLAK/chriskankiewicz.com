<?php

namespace Database\Seeders;

use App\Project;
use App\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Symfony\Component\Yaml\Yaml;

class ProjectSeeder extends Seeder
{
    /** Run the database seeds. */
    public function run(): void
    {
        $projects = Yaml::parseFile(database_path('seeders/data/projects.yaml'));

        foreach ($projects as $project) {
            $project = Collection::make($project);

            if ($project->has('skills')) {
                $skills = array_map(function ($skill) {
                    return Skill::firstOrCreate(['name' => $skill]);
                }, $project->pull('skills'));
            } else {
                $skills = [];
            }

            $project = Project::create($project->all());
            $project->skills()->saveMany($skills);
        }
    }
}
