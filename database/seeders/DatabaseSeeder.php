<?php

namespace Database\Seeders;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = FakerFactory::create(); // Use the imported class to create the Faker instance

        // \App\Models\Right::factory(10)->create();
        // \App\Models\User::factory(10)->create();
        // \App\Models\UserRight::factory(10)->make();
        // $categories = \App\Models\Category::factory(10)->create();
        // \App\Models\Blog::factory(10)->make();
        // \App\Models\Reaction::factory(10)->make();

        

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
