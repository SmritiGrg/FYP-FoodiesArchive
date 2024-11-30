<?php

namespace Database\Seeders;

use App\Models\FoodPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FoodPost::factory()->count(25)->create();
    }
}
