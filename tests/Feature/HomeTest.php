<?php

namespace Tests\Feature;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_access_the_home_page(): void
    {
        $posts = Post::factory()->count(3)->create();

        $response = $this->get(route('home'));

        $response->assertOk()->assertViewIs('blog.index');
        $posts->each(function (Post $post) use ($response): void {
            $response->assertSee($post->title);
        });
    }
}
