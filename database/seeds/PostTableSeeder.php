<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $count = (int) $this->command->ask('How many posts do you need?', 30);
        $posts = Post::factory()->count($count)->create();

        $posts->each(function ($post, $index) use ($faker)
        {
            if ($index % 2 === 0)
            {
                $imageUrl = $faker->imageUrl($faker->numberBetween(800, 1920), $faker->numberBetween(700, 1200), null, false);

                $post->addMediaFromUrl($imageUrl)->toMediaCollection('image');
            }
        });
    }
}
