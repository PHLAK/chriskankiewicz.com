<?php

namespace App\Http\Controllers;

use App\Education;
use Illuminate\View\View;

class EducationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\View\View
     */
    public function __invoke(): View
    {
        return view('education', [
            'education' => Education::orderBy('start_date', 'DESC')->get(),
            'title' => 'Education',
        ]);
    }
}
