<?php

namespace App\Http\Controllers\Api;

use App\Accomplishment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccomplishment;
use App\Http\Requests\UpdateAccomplishment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class AccomplishmentController extends Controller
{
    /** Create a new Accomplishment controller. */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    /** Display a listing of the resource. */
    public function index(): Collection
    {
        return Accomplishment::all();
    }

    /** Store a newly created resource in storage. */
    public function store(StoreAccomplishment $request): Accomplishment
    {
        return Accomplishment::create($request->validated());
    }

    /** Display the specified resource. */
    public function show(Accomplishment $accomplishment): Accomplishment
    {
        return $accomplishment;
    }

    /** Update the specified resource in storage. */
    public function update(UpdateAccomplishment $request, Accomplishment $accomplishment): Accomplishment
    {
        $accomplishment->update($request->validated());

        return $accomplishment;
    }

    /** Remove the specified resource from storage. */
    public function destroy(Accomplishment $accomplishment): Response
    {
        $accomplishment->delete();

        return response(null, 204);
    }
}
