<?php

namespace App\Http\Controllers;

use App\Accomplishment;
use Illuminate\View\View;

class AccomplishmentsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(): View
    {
        return view('accomplishments', [
            'accomplishments' => Accomplishment::all(),
            'title' => 'Accomplishments'
        ]);
    }
}
