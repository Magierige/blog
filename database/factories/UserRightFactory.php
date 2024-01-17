<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserRightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    //word aan geroepen vanaaf de user factory
    public function definition(): array
    {
        return [
            'user_id' => null,
            'right_id' => rand(2, 4),
        ];
    }
}
