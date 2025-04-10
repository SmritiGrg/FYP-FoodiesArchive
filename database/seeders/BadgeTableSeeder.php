<?php

namespace Database\Seeders;

use App\Models\Badge;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BadgeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('badges')->insert([
            // Streak-Based Badges
            [
                'name' => 'Food Enthusiast',
                'description' => 'Earned for a 3-day contribution streak.',
                'streak_criteria' => 3,
                'contribution_required' => null,
                'special_badge' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Tasty Explorer',
                'description' => 'Earned for a 7-day contribution streak.',
                'streak_criteria' => 7,
                'contribution_required' => null,
                'special_badge' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Flavor Chaser',
                'description' => 'Earned for a 14-day contribution streak.',
                'streak_criteria' => 14,
                'contribution_required' => null,
                'special_badge' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Dish Discoverer',
                'description' => 'Earned for a 30-day contribution streak.',
                'streak_criteria' => 30,
                'contribution_required' => null,
                'special_badge' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Master Foodie',
                'description' => 'Earned for a 60-day contribution streak.',
                'streak_criteria' => 60,
                'contribution_required' => null,
                'special_badge' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Ultimate Food Traveler',
                'description' => 'Earned for a 100-day contribution streak.',
                'streak_criteria' => 100,
                'contribution_required' => null,
                'special_badge' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Contribution-Based Badges
            [
                'name' => 'Rising Foodie',
                'description' => 'Earned after the first contribution (food post or review).',
                'streak_criteria' => null,
                'contribution_required' => 1,
                'special_badge' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Taste Tester',
                'description' => 'Earned after 5 total contributions.',
                'streak_criteria' => null,
                'contribution_required' => 5,
                'special_badge' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Taste Master',
                'description' => 'Earned after 20 total contributions.',
                'streak_criteria' => null,
                'contribution_required' => 20,
                'special_badge' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Wander & Feast',
                'description' => 'Earned after 50 total contributions.',
                'streak_criteria' => null,
                'contribution_required' => 50,
                'special_badge' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Legendary Foodie',
                'description' => 'Earned after 100 total contributions.',
                'streak_criteria' => null,
                'contribution_required' => 100,
                'special_badge' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Community Engagement Badges
            [
                'name' => 'Friendly Foodie',
                'description' => 'Earned after writing 10 answers in the Q&A section.',
                'streak_criteria' => null,
                'contribution_required' => null,
                'special_badge' => '10_answers',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Food Guru',
                'description' => 'Earned after writing 30 answers in the Q&A section.',
                'streak_criteria' => null,
                'contribution_required' => null,
                'special_badge' => '30_answers',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Trendsetter',
                'description' => 'Earned when a post gets 50+ likes.',
                'streak_criteria' => null,
                'contribution_required' => null,
                'special_badge' => 'post_50_likes',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Culinary Influencer',
                'description' => 'Earned when a post gets 100+ likes.',
                'streak_criteria' => null,
                'contribution_required' => null,
                'special_badge' => 'post_100_likes',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // Badge::create([
        //     'name' => 'Best Food Traveler',
        //     'streak_criteria' => 15,
        //     'image' => 'best_food_traveler.jpg',
        // ]);

        // Badge::create([
        //     'name' => 'Top Foodie',
        //     'streak_criteria' => 55,
        //     'image' => 'Best Foodie.png',
        // ]);

        // Badge::create([
        //     'name' => 'Master Reviewer',
        //     'streak_criteria' => 62,
        //     'image' => 'best_food_traveler.jpg',
        // ]);

        // Badge::create([
        //     'name' => 'Local Expert',
        //     'streak_criteria' => 66,
        //     'image' => 'top_foodie.jpg',
        // ]);

        // Badge::create([
        //     'name' => 'Peoples Favorite',
        //     'streak_criteria' => 150,
        //     'image' => 'best_food_traveler.jpg',
        // ]);
    }
}
