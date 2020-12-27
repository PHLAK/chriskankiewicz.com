<?php

namespace Tests\Feature\Api;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_all_posts()
    {
        Post::factory()->count(3)->create();

        $response = $this->json('GET', route('post.index'));

        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonStructure([
                ['slug', 'title', 'body', 'featured_image_url', 'featured_image_text', 'published_at'],
            ]);
    }

    /** @test */
    public function it_can_get_an_individual_post()
    {
        Post::factory()->create();
        $post = Post::factory()->create();
        Post::factory()->create();

        $response = $this->json('GET', route('post.show', [
            'post' => $post,
        ]));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'slug', 'title', 'body', 'featured_image_url', 'featured_image_text', 'published_at',
            ]);
    }

    /** @test */
    public function it_can_create_a_new_post()
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user, 'api')
            ->json('POST', route('post.store'), [
                'slug' => 'test-post-please-ignore',
                'title' => 'Test post; please ignore',
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'featured_image_url' => 'https://via.placeholder.com/1200/800',
                'featured_image_text' => 'Some image text',
                'published_at' => Carbon::create(1986, 5, 20, 12, 34, 56),
            ]);

        $response->assertStatus(201)
            ->assertJson([
                'slug' => 'test-post-please-ignore',
                'title' => 'Test post; please ignore',
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'featured_image_url' => 'https://via.placeholder.com/1200/800',
                'featured_image_text' => 'Some image text',
                'published_at' => '1986-05-20T12:34:56.000000Z',
            ]);
    }

    /** @test */
    public function it_can_update_a_post()
    {
        $user = User::factory()->admin()->create();
        $post = Post::factory()->create();

        $response = $this->actingAs($user, 'api')
            ->json('PATCH', route('post.update', ['post' => $post]), [
                'slug' => 'test-post-please-ignore',
                'title' => 'Test post; please ignore',
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'featured_image_url' => 'https://via.placeholder.com/1200/800',
                'featured_image_text' => 'Some image text',
                'published_at' => Carbon::create(1986, 5, 20, 12, 34, 56),
            ]);

        $response->assertStatus(200)
            ->assertJson([
                'slug' => 'test-post-please-ignore',
                'title' => 'Test post; please ignore',
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'featured_image_url' => 'https://via.placeholder.com/1200/800',
                'featured_image_text' => 'Some image text',
                'published_at' => '1986-05-20T12:34:56.000000Z',
            ]);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'slug' => 'test-post-please-ignore',
            'title' => 'Test post; please ignore',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'featured_image_url' => 'https://via.placeholder.com/1200/800',
            'featured_image_text' => 'Some image text',
            'published_at' => '1986-05-20 12:34:56',
        ]);
    }

    /** @test */
    public function it_can_delete_an_post()
    {
        $user = User::factory()->admin()->create();
        Post::factory()->create();
        $post = Post::factory()->create();
        Post::factory()->create();

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', route('post.destroy', ['post' => $post]));

        $response->assertStatus(204);
        $this->assertSoftDeleted('posts', [
            'id' => $post->id,
        ]);
    }
}
