<?php

namespace Tests\Feature;

use App\Post;
use App\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_access_the_tag_page(): void
    {
        $tag = factory(Tag::class)->create();

        $posts = factory(Post::class, 3)->create()->each(
            fn (Post $post) => $post->tags()->save($tag)
        );

        $otherPost = factory(Post::class)->create();

        $response = $this->get(route('tag', ['slug' => $tag->slug]));

        $response->assertOk()->assertViewIs('blog.index')->assertViewHas('title', $tag->name);

        $posts->each(function (Post $post) use ($response): void {
            $response->assertSee($post->title);
        });

        $response->assertDontSee($otherPost->title);
    }
}
