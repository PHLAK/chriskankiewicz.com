<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Accomplishment;
use App\Education;
use App\Experience;
use App\Project;
use App\Skill;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('index', [
            'accomplishments' => Accomplishment::all(),
            'education' => Education::orderBy('start_date', 'DESC')->get(),
            'experience' => Experience::orderBy('start_date', 'DESC')->get(),
            'projects' => Project::all(),
            'skills' => Skill::all()
        ]);
    }
}
