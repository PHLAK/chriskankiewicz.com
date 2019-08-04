<?php

namespace App\Http\Controllers\Api;

use App\Accomplishment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccomplishment;
use App\Http\Requests\UpdateAccomplishment;

class AccomplishmentController extends Controller
{
    /**
     * Create a new Accomplishment controller.
     *
     * @return void
     */
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
        return Accomplishment::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreAccomplishment $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccomplishment $request)
    {
        return Accomplishment::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Accomplishment $accomplishment
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Accomplishment $accomplishment)
    {
        return $accomplishment;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateAccomplishment $request
     * @param \App\Accomplishment                     $accomplishment
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccomplishment $request, Accomplishment $accomplishment)
    {
        $accomplishment->update($request->validated());

        return $accomplishment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Accomplishment $accomplishment
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accomplishment $accomplishment)
    {
        $accomplishment->delete();

        return response(null, 204);
    }
}
