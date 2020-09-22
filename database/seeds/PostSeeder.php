<?php

use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (glob(database_path('seeds/data/posts/*.md')) as $file) {
            $post = YamlFrontMatter::parseFile($file);

            $winkPost = Post::create([
                'slug' => Str::slug($post->title),
                'title' => $post->title,
                'body' => $post->body(),
                'published_at' => Carbon::parse($post->published),
                'featured_image' => $post->featured_image,
                'featured_image_text' => $post->featured_image_text,
            ]);

            if (is_array($post->tags)) {
                $winkPost->tags()->saveMany(Collection::make($post->tags)->map(
                    fn (string $tag) => Tag::firstOrCreate(['slug' => Str::slug($tag)], ['name' => $tag])
                ));
            }
        }
    }
}
