<?php

namespace Database\Seeders;

use App\Models\Likes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Likes::factory()->count(30)->create();
    }
}
