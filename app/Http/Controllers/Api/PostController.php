<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePost;
use App\Http\Requests\UpdatePost;
use App\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /** Create a new Post controller. */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    /** Display a listing of the resource. */
    public function index(): Collection
    {
        return Post::all();
    }

    /** Store a newly created resource in storage. */
    public function store(StorePost $request): Post
    {
        return Post::create($request->validated());
    }

    /** Display the specified resource. */
    public function show(Post $post): Post
    {
        return $post;
    }

    /** Update the specified resource in storage. */
    public function update(UpdatePost $request, Post $post): Post
    {
        $post->update($request->validated());

        return $post;
    }

    /** Remove the specified resource from storage. */
    public function destroy(Post $post): Response
    {
        $post->delete();

        return response(null, 204);
    }
}
