<?php

namespace App\Http\Controllers;

use Canvas\Tag;
use Canvas\Post;
use Canvas\Topic;
use Illuminate\View\View;
use Canvas\Events\PostViewed;
use Illuminate\Support\Collection;

class BlogController extends Controller
{
    /**
     * Show the blog index page.
     *
     * @return \Illuminate\View\View
     */
    public function getPosts(): View
    {
        $data = [
            'posts'  => Post::published()->orderByDesc('published_at')->simplePaginate(10),
            'topics' => Topic::all(['name', 'slug']),
            'tags'   => Tag::all(['name', 'slug']),
        ];

        return view('blog.index', compact('data'));
    }

    /**
     * Show a post given a slug.
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function findPostBySlug(string $slug): View
    {
        $posts = Post::with('tags', 'topic')->published()->get();
        $post = $posts->firstWhere('slug', $slug);

        if ($post && $post->published) {
            $readNext = $posts->sortBy('published_at')->firstWhere('published_at', '>', $post->published_at);

            if ($readNext) {
                $randomPool = $posts->filter(function ($item) use ($readNext, $post) {
                    return $item->id != $post->id && $item->id != $readNext->id;
                });
            } else {
                $randomPool = $posts->filter(function ($item) use ($readNext, $post) {
                    return $item->id != $post->id;
                });
            }

            if ($post->tags || $post->topic) {
                $related = $this->findRelatedViaTaxonomy($randomPool, $post);
                $readRandom = $related->isEmpty() ? null : $related->first();
            } else {
                $readRandom = $randomPool->random();
            }

            $data = [
                'author' => $post->author,
                'post'   => $post,
                'meta'   => $post->meta,
                'next'   => $readNext,
                'random' => $readRandom,
                'topic'  => $post->topic->first() ?? null,
            ];

            event(new PostViewed($post));

            return view('blog.show', compact('data'));
        } else {
            abort(404);
        }
    }

    /**
     * Show all posts given a tag.
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function getPostsByTag(string $slug): View
    {
        if (Tag::where('slug', $slug)->first()) {
            $data = [
                'tag'    => Tag::with('posts')->where('slug', $slug)->first(),
                'tags'   => Tag::all(['name', 'slug']),
                'topics' => Topic::all(['name', 'slug']),
                'posts'  => Post::whereHas('tags', function ($query) use ($slug) {
                    $query->where('slug', $slug);
                })->published()->orderByDesc('published_at')->simplePaginate(10),
            ];

            return view('blog.index', compact('data'));
        } else {
            abort(404);
        }
    }

    /**
     * Show all posts given a topic.
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function getPostsByTopic(string $slug): View
    {
        if (Topic::where('slug', $slug)->first()) {
            $data = [
                'tags'   => Tag::all(['name', 'slug']),
                'topics' => Topic::all(['name', 'slug']),
                'topic'  => Topic::with('posts')->where('slug', $slug)->first(),
                'posts'  => Post::whereHas('topic', function ($query) use ($slug) {
                    $query->where('slug', $slug);
                })->published()->orderByDesc('published_at')->simplePaginate(10),
            ];

            return view('blog.index', compact('data'));
        } else {
            abort(404);
        }
    }

    /**
     * @param \Illuminate\Support\Collection $randomPool
     * @param \Canvas\Post $post
     * @return mixed
     */
    private function findRelatedViaTaxonomy(Collection $randomPool, Post $post)
    {
        return collect($randomPool)->filter(function($item, $key) use ($post) {
            $matched_tag = array_intersect($item->tags->pluck('slug')->toArray(), $post->tags->pluck('slug')->toArray());
            $matched_topic = array_intersect($item->topic->pluck('slug')->toArray(), $post->topic->pluck('slug')->toArray());

            if ($matched_tag || $matched_topic) {
                return true;
            } else {
                return false;
            }
        });
    }
}
