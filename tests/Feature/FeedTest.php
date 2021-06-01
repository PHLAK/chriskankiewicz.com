<?php

namespace Tests\Feature;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_access_the_feed(): void
    {
        $posts = Post::factory()->count(3)->create();

        $response = $this->get(route('feeds.main'));

        $response->assertOk()->assertViewIs('feed::atom');
        $posts->each(function (Post $post) use ($response): void {
            $response->assertSee($post->title);
        });
    }
}
