<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;

class FeedTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_access_the_feed(): void
    {
        $this->markTestSkipped();

        // TODO: Re-enable when spatie/laravel-feed is working again
        // $posts = Post::factory()->count(3)->create();

        // $response = $this->get(route('feeds.main'));

        // $response->assertOk()->assertViewIs('feed::atom');
        // $posts->each(function (Post $post) use ($response): void {
        //     $response->assertSee($post->title);
        // });
    }
}
