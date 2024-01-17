<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class restSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = \App\Models\User::factory(10)->create();
        foreach($users as $user){
            $right = \App\Models\UserRight::factory()->make();
            $right->user_id = $user->id;
            $right->save();
        }
        $categories = \App\Models\Category::factory(10)->create();
        foreach($categories as $category){
            $blogs = \App\Models\Blog::factory(5)->make();
            foreach($blogs as $blog){
                $blog->category_id = $category->id;
                $blog->save();

                $likes = \App\Models\UserLikes::factory(5)->make();
                $blogTell = 0;
                $blogNumbers = [];
                while (count($blogNumbers) < 5) {
                    $number = rand(1, 14);
                    if (!in_array($number, $blogNumbers)) {
                        $blogNumbers[] = $number;
                    }
                }
                foreach($likes as $like){
                    $like->blog_id = $blog->id;
                    $like->user_id = $blogNumbers[$blogTell];
                    $like->save();
                    $blogTell++;
                }
                $reactions = \App\Models\Reaction::factory(3)->make();
                foreach($reactions as $reaction){

                    $likes = \App\Models\UserLikes::factory(5)->make();
                    $recTell = 0;
                    $reactionNumbers = [];
                    while (count($reactionNumbers) < 5) {
                        $number = rand(1, 14);
                        if (!in_array($number, $reactionNumbers)) {
                            $reactionNumbers[] = $number;
                        }
                    }
                    

                    $reaction->blog_id = $blog->id;
                    $reaction->save();
                    foreach($likes as $like){
                        $like->reaction_id = $reaction->id;
                        $like->user_id = $reactionNumbers[$recTell];
                        $like->save();
                        $recTell++;
                    }
                }
            }
        }
    }
}
