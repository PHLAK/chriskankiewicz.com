<?php

namespace Tests\Feature;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_access_a_post(): void
    {
        $post = Post::factory()->create();

        $response = $this->get(route('post', ['post' => $post]));

        $response->assertOk()->assertViewIs('blog.post')->assertSee($post->title);
    }
}
