<?php

namespace App\Http\Controllers\Api;

use App\Experience;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExperience;
use App\Http\Requests\UpdateExperience;

class ExperienceController extends Controller
{
    /** Create a new Experience controller. */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Experience::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExperience $request)
    {
        return Experience::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Experience $experience)
    {
        return $experience;
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExperience $request, Experience $experience)
    {
        $experience->update($request->validated());

        return $experience;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Experience $experience)
    {
        $experience->delete();

        return response(null, 204);
    }
}
