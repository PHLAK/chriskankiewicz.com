<?php

namespace Tests\Feature;

use App\Http\Controllers\PostController;
use App\Post;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(PostController::class)]
class PostTest extends TestCase
{
    #[Test]
    public function it_can_access_a_post(): void
    {
        $post = Post::factory()->create();

        $response = $this->get(route('post', ['post' => $post]));

        $response->assertOk()->assertViewIs('blog.post')->assertSee($post->title);
    }
}
