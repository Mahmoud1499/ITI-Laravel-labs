<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //public function run(): void
        {
            //
            for ($i = 1; $i < 500; $i++) {
                DB::table('posts')->insert([
                    'title' => Str::random(5),
                    'description' => Str::random(100),
                    'user_id' => User::all()->random()->id
                ]);
            }
        }
    }
}
