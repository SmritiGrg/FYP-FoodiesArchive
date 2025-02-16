<?php

namespace Database\Seeders;

use App\Models\Badges;
use App\Models\User;
use App\Models\UserBadges;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserBadgeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all users and badges
        $users = User::all();
        $badges = Badges::all();

        // Loop through each user and assign badges based on their streak count
        foreach ($users as $user) {
            // Loop through each badge
            foreach ($badges as $badge) {
                // Check if the user's streak count meets or exceeds the badge's streak criteria
                if ($user->streak_count >= $badge->streak_criteria) {
                    // Assign the badge to the user
                    UserBadges::create([
                        'user_id' => $user->id,
                        'badge_id' => $badge->id,
                        'awarded_date' => now(), // Awarded at the current timestamp
                    ]);
                }
            }
        }
    }
}
