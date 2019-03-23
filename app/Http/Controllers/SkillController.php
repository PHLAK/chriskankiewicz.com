<?php

namespace App\Http\Controllers;

use App\Skill;
use App\Http\Requests\StoreSkill;
use App\Http\Requests\UpdateSkill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Skill::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSkill  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSkill $request)
    {
        return Skill::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {
        return $skill;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSkill  $request
     * @param  \App\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSkill $request, Skill $skill)
    {
        $skill->update($request->validated());

        return $skill;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();

        return response(null, 204);
    }
}
