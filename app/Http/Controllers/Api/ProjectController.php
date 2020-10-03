<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProject;
use App\Http\Requests\UpdateProject;
use App\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    /** Create a new Project controller. */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    /** Display a listing of the resource. */
    public function index(): Collection
    {
        return Project::all();
    }

    /** Store a newly created resource in storage. */
    public function store(StoreProject $request): Project
    {
        return Project::create($request->validated());
    }

    /** Display the specified resource. */
    public function show(Project $project): Project
    {
        return $project;
    }

    /** Update the specified resource in storage. */
    public function update(UpdateProject $request, Project $project): Project
    {
        $project->update($request->validated());

        return $project;
    }

    /** Remove the specified resource from storage. */
    public function destroy(Project $project): Response
    {
        $project->delete();

        return response(null, 204);
    }
}
