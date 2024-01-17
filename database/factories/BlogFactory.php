<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // Add this line
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tumbnail' => 'https://source.unsplash.com/random/800x600',
            'content' => "<html><body><p>" . $this->faker->realText($maxNbChars = 100, $indexSize = 2) . "</p><img src='https://source.unsplash.com/random/800x600'></img><p>" . $this->faker->realText($maxNbChars = 100, $indexSize = 2) . "</p></body></html>",
            'title' => $this->faker->word(),
            //'title' => 'levens haat',
            //'content' => "<html><body><p> ik haat leven</p><img src='https://source.unsplash.com/random/800x600'></img><p>fuck faker</p></body></html>",
            'user_id' => rand(1,14), 
            'category_id' => null,
        ];
    }
}