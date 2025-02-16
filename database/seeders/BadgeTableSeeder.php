<?php

namespace Database\Seeders;

use App\Models\Badges;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BadgeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Badges::create([
            'name' => 'Best Food Traveler',
            'streak_criteria' => 15,
            'image' => 'best_food_traveler.jpg',
        ]);

        Badges::create([
            'name' => 'Top Foodie',
            'streak_criteria' => 55,
            'image' => 'top_foodie.jpg',
        ]);

        Badges::create([
            'name' => 'Master Reviewer',
            'streak_criteria' => 62,
            'image' => 'best_food_traveler.jpg',
        ]);

        Badges::create([
            'name' => 'Local Expert',
            'streak_criteria' => 66,
            'image' => 'top_foodie.jpg',
        ]);

        Badges::create([
            'name' => 'Peoples Favorite',
            'streak_criteria' => 150,
            'image' => 'best_food_traveler.jpg',
        ]);
    }
}
