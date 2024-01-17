<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserLikes>
 */
class UserLikesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'like' => rand(0, 1),
            'reaction_id' => null,
            'blog_id' => null,
            'user_id' => null,
        ];
    }
}
