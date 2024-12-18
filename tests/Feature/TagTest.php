<?php

namespace Tests\Feature;

use App\Post;
use App\Tag;
use Tests\TestCase;

class TagTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_access_the_tag_page(): void
    {
        $tag = Tag::factory()->create();

        $posts = Post::factory()->count(3)->create()->each(
            fn (Post $post) => $post->tags()->save($tag)
        );

        $otherPost = Post::factory()->create();

        $response = $this->get(route('tag', ['tag' => $tag]));

        $response->assertOk()->assertViewIs('blog.index')->assertViewHas('title', $tag->name);

        $posts->each(function (Post $post) use ($response): void {
            $response->assertSee($post->title);
        });

        $response->assertDontSee($otherPost->title);
    }
}
