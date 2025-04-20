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
        $count = 0;
        $maxFollows = 100;

        // Get all user IDs except admin (ID = 1)
        $userIds = User::where('id', '!=', 1)->pluck('id')->toArray();

        while ($count < $maxFollows) {
            $followerId = collect($userIds)->random();
            $followedId = collect($userIds)->random();

            if (
                $followerId !== $followedId &&
                !collect($follows)->contains(fn($f) => $f['follower_id'] === $followerId && $f['followed_id'] === $followedId)
            ) {

                $follows[] = [
                    'follower_id' => $followerId,
                    'followed_id' => $followedId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $count++;
            }
        }

        Follows::upsert($follows, ['follower_id', 'followed_id']);
    }
}
