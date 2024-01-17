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
        $this->call([
            rightSeeder::class, 
            UserSeeder::class,
            restSeeder::class,
        ]);
    }
}
