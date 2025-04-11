<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\FoodPost;
use Carbon\Carbon;

abstract class Controller
{
    public function updateStreak($user, $points)
    {
        if (
            $user->last_activity_date &&
            Carbon::parse($user->last_activity_date)->lt(now()->subDays(7))
        ) {
            $user->streak_count = 0;
        }

        $user->streak_count += $points;
        $user->total_streak_points += $points;
        $user->last_activity_date = now();
        $user->save();
    }

    public function checkForBadges($user)
    {
        $badges = Badge::all();

        foreach ($badges as $badge) {
            $alreadyHas = $user->badges()->where('badge_id', $badge->id)->exists();

            if ($alreadyHas) continue;

            if (
                ($badge->streak_criteria && $user->total_streak_points >= $badge->streak_criteria) ||
                ($badge->contribution_required && ($user->reviews()->count() + $user->foodPosts()->count()) >= $badge->contribution_required)
            ) {
                $user->badges()->attach($badge->id, [
                    'awarded_date' => now(),
                ]);
                return $badge; // returning the badge
            }
        }

        return null;
    }

    public function checkForLikeBasedBadges($user)
    {
        // Total likes across all their posts
        $totalLikes = $user->foodPosts()->withCount('likes')->get()->sum('likes_count');
        // logger("Total likes for user {$user->id}: $totalLikes");

        $badges = Badge::whereIn('special_badge', ['post_50_likes', 'post_100_likes'])->get();

        foreach ($badges as $badge) {
            $alreadyHas = $user->badges()->where('badge_id', $badge->id)->exists();
            if ($alreadyHas) continue;

            // You can customize the value check here
            if (($badge->special_badge === 'post_50_likes' && $totalLikes >= 2) ||
                ($badge->special_badge === 'post_100_likes' && $totalLikes >= 100)
            ) {

                $user->badges()->attach($badge->id, ['awarded_date' => now()]);
                return $badge;
            }
        }

        return null;
    }
}
