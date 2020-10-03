<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSkill;
use App\Http\Requests\UpdateSkill;
use App\Skill;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class SkillController extends Controller
{
    /** Create a new Skill controller. */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    /** Display a listing of the resource. */
    public function index(): Collection
    {
        return Skill::all();
    }

    /** Store a newly created resource in storage. */
    public function store(StoreSkill $request): Skill
    {
        return Skill::create($request->validated());
    }

    /** Display the specified resource. */
    public function show(Skill $skill): Skill
    {
        return $skill;
    }

    /** Update the specified resource in storage. */
    public function update(UpdateSkill $request, Skill $skill): Skill
    {
        $skill->update($request->validated());

        return $skill;
    }

    /** Remove the specified resource from storage. */
    public function destroy(Skill $skill): Response
    {
        $skill->delete();

        return response(null, 204);
    }
}
