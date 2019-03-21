<?php

namespace App\Http\Controllers;

use App\Education;
use App\Http\Requests\StoreEducation;
use App\Http\Requests\UpdateEducation;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Education::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEducation  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEducation $request)
    {
        return Education::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function show(Education $education)
    {
        return $education;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEducation  $request
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEducation $request, Education $education)
    {
        $education->update($request->validated());

        return $education;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function destroy(Education $education)
    {
        $education->delete();

        return response(null, 204);
    }
}
