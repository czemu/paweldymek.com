<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = ucfirst($this->faker->sentence(4, true));

        return [
            'locale' => $this->faker->randomElement(['pl', 'en']),
            'name' => $name,
            'slug' => \Str::slug($name),
            'intro' => $this->faker->text($this->faker->numberBetween(300, 800)),
            'content' => $this->faker->text($this->faker->numberBetween(1200, 10000)),
            'is_published' => $this->faker->numberBetween(0, 1),
        ];
    }
}
