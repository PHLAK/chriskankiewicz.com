<?php

namespace Tests\Feature;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_access_a_post(): void
    {
        $post = Post::factory()->create();

        $response = $this->get(route('post', ['slug' => $post->slug]));

        $response->assertOk()->assertViewIs('blog.post')->assertSee($post->title);
    }
}
