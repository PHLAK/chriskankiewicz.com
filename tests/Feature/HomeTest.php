<?php

namespace Tests\Feature;

use App\Http\Controllers\HomeController;
use App\Post;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(HomeController::class)]
class HomeTest extends TestCase
{
    #[Test]
    public function it_can_access_the_home_page(): void
    {
        $posts = Post::factory()->count(3)->create();

        $response = $this->get(route('home'));

        $response->assertOk()->assertViewIs('blog.index');
        $posts->each(function (Post $post) use ($response): void {
            $response->assertSee($post->title);
        });
    }
}
