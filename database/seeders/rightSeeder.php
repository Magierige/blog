<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class rightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rights')->insert([
            'right' => 'admin',
        ]);
        db::table('rights')->insert([
            'right' => 'categorizer',
        ]);
        DB::table('rights')->insert([
            'right' => 'author',
        ]);
        DB::table('rights')->insert([
            'right' => 'user',
        ]);
    }
}
