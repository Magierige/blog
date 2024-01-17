<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; 
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin666'),
            'email_verified_at' => now(),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'profile_photo_path' => null,
            'current_team_id' => null,
            'remember_token' => Str::random(10), 
        ]);
        DB::table('user_rights')->insert([
            'user_id' => 1,
            'right_id' => 1,
        ]);
        
        DB::table('users')->insert([
            'name' => 'cat',
            'email' => 'cat@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'profile_photo_path' => null,
            'current_team_id' => null,
            'remember_token' => Str::random(10), 
        ]);
        DB::table('user_rights')->insert([
            'user_id' => 2,
            'right_id' => 2,
        ]);

        DB::table('users')->insert([
            'name' => 'author',
            'email' => 'author@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'profile_photo_path' => null,
            'current_team_id' => null,
            'remember_token' => Str::random(10), 
        ]);
        DB::table('user_rights')->insert([
            'user_id' => 3,
            'right_id' => 3,
        ]);

        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'profile_photo_path' => null,
            'current_team_id' => null,
            'remember_token' => Str::random(10), 
        ]);
        DB::table('user_rights')->insert([
            'user_id' => 4,
            'right_id' => 4,
        ]);
    }
}

