<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Education;
use App\Experience;
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
            'education' => Education::all(),
            'experience' => Experience::all(),
            'skills' => Skill::all()
        ]);
    }
}
