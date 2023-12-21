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

        // \App\Models\Right::factory(10)->create(); // krijgt eigen seeder
        //er moet een seeder komen voor het maken van de admin account
        $this->call([
            rights::class, 
            UserSeeder::class,
        ]);
        
        $users = \App\Models\User::factory(10)->create();
        foreach($users as $user){
            $right = \App\Models\UserRight::factory()->make();
            $right->user_id = $user->id;
            $right->save();
        }
        // \App\Models\UserRight::factory(10)->make();
        $categories = \App\Models\Category::factory(10)->create();
        foreach($categories as $category){
            $blogs = \App\Models\Blog::factory(10)->make();
            foreach($blogs as $blog){
                $blog->category_id = $category->id;
                $blog->save();
                $reactions = \App\Models\Reaction::factory(3)->make();
                foreach($reactions as $reaction){
                    $reaction->blog_id = $blog->id;
                    $reaction->save();
                }
            }
        }
        // \App\Models\Blog::factory(10)->make();
        // \App\Models\Reaction::factory(10)->make();

        

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
