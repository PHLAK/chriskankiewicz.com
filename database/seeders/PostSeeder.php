<?php

namespace Database\Seeders;

use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class PostSeeder extends Seeder
{
    /** Run the database seeds. */
    public function run(): void
    {
        foreach (glob(database_path('seeders/data/posts/*.md')) as $file) {
            $parsed = YamlFrontMatter::parseFile($file);

            $post = Post::create([
                'slug' => Str::slug($parsed->title),
                'title' => $parsed->title,
                'body' => $parsed->body(),
                'published_at' => Carbon::parse($parsed->published),
                'featured_image_url' => $parsed->featured_image_url,
                'featured_image_text' => $parsed->featured_image_text,
            ]);

            if (is_array($parsed->tags)) {
                $post->tags()->saveMany(Collection::make($parsed->tags)->map(
                    fn (string $tag) => Tag::firstOrCreate(['slug' => Str::slug($tag)], ['name' => $tag])
                ));
            }
        }
    }
}
