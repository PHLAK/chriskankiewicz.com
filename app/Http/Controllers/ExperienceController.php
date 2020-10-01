<?php

namespace App\Http\Controllers;

use App\Experience;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    /** Handle the incoming request. */
    public function __invoke(): View
    {
        return view('experience', [
            'experience' => Experience::orderBy('start_date', 'DESC')->get(),
            'title' => 'Experience',
        ]);
    }
}
