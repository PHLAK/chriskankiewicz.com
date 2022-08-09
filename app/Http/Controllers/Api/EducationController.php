<?php

namespace App\Http\Controllers\Api;

use App\Education;
use App\Http\Controllers\Controller;
use App\Http\Requests\EducationRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class EducationController extends Controller
{
    /** Create a new Education controller. */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    /** Display a listing of the resource. */
    public function index(): Collection
    {
        return Education::all();
    }

    /** Store a newly created resource in storage. */
    public function store(EducationRequest $request): Education
    {
        return Education::create($request->validated());
    }

    /** Display the specified resource. */
    public function show(Education $education): Education
    {
        return $education;
    }

    /** Update the specified resource in storage. */
    public function update(EducationRequest $request, Education $education): Education
    {
        $education->update($request->validated());

        return $education;
    }

    /** Remove the specified resource from storage. */
    public function destroy(Education $education): Response
    {
        $education->delete();

        return response()->noContent();
    }
}
