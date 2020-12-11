<?php

namespace Tests\Feature;

use App\Post;
use App\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_access_the_tag_page(): void
    {
        $tag = Tag::factory()->create();

        $posts = Post::factory()->count(3)->create()->each(
            fn (Post $post) => $post->tags()->save($tag)
        );

        $otherPost = Post::factory()->create();

        $response = $this->get(route('tag', ['slug' => $tag->slug]));

        $response->assertOk()->assertViewIs('blog.index')->assertViewHas('title', $tag->name);

        $posts->each(function (Post $post) use ($response): void {
            $response->assertSee($post->title);
        });

        $response->assertDontSee($otherPost->title);
    }
}
