<?php

namespace App\Http\Controllers\Api;

use App\Experience;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExperience;
use App\Http\Requests\UpdateExperience;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class ExperienceController extends Controller
{
    /** Create a new Experience controller. */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    /** Display a listing of the resource. */
    public function index(): Collection
    {
        return Experience::all();
    }

    /** Store a newly created resource in storage. */
    public function store(StoreExperience $request): Experience
    {
        return Experience::create($request->validated());
    }

    /** Display the specified resource. */
    public function show(Experience $experience): Experience
    {
        return $experience;
    }

    /** Update the specified resource in storage. */
    public function update(UpdateExperience $request, Experience $experience): Experience
    {
        $experience->update($request->validated());

        return $experience;
    }

    /** Remove the specified resource from storage. */
    public function destroy(Experience $experience): Response
    {
        $experience->delete();

        return response(null, 204);
    }
}
