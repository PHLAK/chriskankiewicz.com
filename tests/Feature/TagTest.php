<?php

namespace Tests\Feature;

use App\Http\Controllers\TagController;
use App\Post;
use App\Tag;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(TagController::class)]
class TagTest extends TestCase
{
    #[Test]
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
