<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\View\View;

class ProjectsController extends Controller
{
    /** Handle the incoming request. */
    public function __invoke(): View
    {
        return view('projects', [
            'projects' => Project::all(),
            'title' => 'Projects',
        ]);
    }
}
