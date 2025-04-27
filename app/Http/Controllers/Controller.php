<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\FoodPost;
use Carbon\Carbon;

abstract class Controller
{
    public function updateStreak($user, $points)
    {
        $streakReset = false;
        if (
            $user->last_activity_date &&
            Carbon::parse($user->last_activity_date)->lt(now()->subDays(7))
        ) {
            $user->streak_count = 0;
            $streakReset = true;
        }

        $user->streak_count += $points;
        $user->total_streak_points += $points;
        $user->last_activity_date = now();
        $user->save();

        return $streakReset;
    }

    public function checkForBadges($user)
    {
        $badges = Badge::all();

        foreach ($badges as $badge) {
            $alreadyHas = $user->badges()->where('badge_id', $badge->id)->exists();

            if ($alreadyHas) continue;

            // Premium badge check
            if ($badge->is_premium && $user->role !== 'premium_user') {
                continue; // skipping premium badges for non-premium users
            }

            //Checking criteria for each badge
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

            // Skipping premium badges if user is not premium
            if ($badge->is_premium && $user->role !== 'premium_user') {
                continue;
            }

            if ($badge->special_badge === 'post_100_likes' && $totalLikes >= 5) {
                if (!$user->badges->contains($badge->id)) {
                    $user->badges()->attach($badge->id, ['awarded_date' => now()]);
                }
                return $badge;
            } elseif ($badge->special_badge === 'post_50_likes' && $totalLikes >= 1) {
                if (!$user->badges->contains($badge->id)) {
                    $user->badges()->attach($badge->id, ['awarded_date' => now()]);
                }
                return $badge;
            }
        }

        return null;
    }
}
