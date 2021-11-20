<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = (int) $this->command->ask('How many tags do you need?', 30);

        $tags = Tag::factory()->count($count)->create();

        $tags->each(function ($tag)
        {
            $tag->posts()->attach(Post::inRandomOrder()->first()->id);
        });
    }
}
