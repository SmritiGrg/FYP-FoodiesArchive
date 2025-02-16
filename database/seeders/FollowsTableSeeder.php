<?php

namespace Database\Seeders;

use App\Models\Follows;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FollowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $follows = [];

        for ($i = 0; $i < 100; $i++) { // Generate 100 follow relationships
            $followerId = User::inRandomOrder()->value('id');
            $followedId = User::inRandomOrder()->value('id');

            if ($followerId !== $followedId) {
                $follows[] = [
                    'follower_id' => $followerId,
                    'followed_id' => $followedId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert or ignore duplicates
        Follows::upsert($follows, ['follower_id', 'followed_id']);
    }
}
