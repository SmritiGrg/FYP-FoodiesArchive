<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\FoodPost;
use App\Models\Restaurants;
use App\Models\Reviews;
use App\Models\Tags;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $thisMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();

        // Total users excluding admin
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $usersThisMonth = User::where('role', '!=', 'admin')
            ->where('created_at', '>=', $thisMonth)
            ->count();
        $usersLastMonth = User::where('role', '!=', 'admin')
            ->whereBetween('created_at', [$lastMonth, $thisMonth])
            ->count();
        $userGrowth = $this->calculateGrowth($usersThisMonth, $usersLastMonth);

        // Premium users
        $premiumUsers = User::where('role', 'premium_user')->count();
        $premiumThisMonth = User::where('role', 'premium_user')
            ->where('created_at', '>=', $thisMonth)
            ->count();
        $premiumLastMonth = User::where('role', 'premium_user')
            ->whereBetween('created_at', [$lastMonth, $thisMonth])
            ->count();
        $premiumGrowth = $this->calculateGrowth($premiumThisMonth, $premiumLastMonth);

        // Food posts
        $totalFoodPosts = FoodPost::count();
        $postsThisMonth = FoodPost::where('created_at', '>=', $thisMonth)->count();
        $postsLastMonth = FoodPost::whereBetween('created_at', [$lastMonth, $thisMonth])->count();
        $postGrowth = $this->calculateGrowth($postsThisMonth, $postsLastMonth);

        // Reviews (main only)
        $totalMainReviews = Reviews::whereNull('parent_id')->count();
        $reviewsThisMonth = Reviews::whereNull('parent_id')
            ->where('created_at', '>=', $thisMonth)
            ->count();
        $reviewsLastMonth = Reviews::whereNull('parent_id')
            ->whereBetween('created_at', [$lastMonth, $thisMonth])
            ->count();
        $reviewGrowth = $this->calculateGrowth($reviewsThisMonth, $reviewsLastMonth);

        return view('admin.index', compact(
            'totalUsers',
            'premiumUsers',
            'totalFoodPosts',
            'totalMainReviews',
            'userGrowth',
            'premiumGrowth',
            'postGrowth',
            'reviewGrowth',
            'usersLastMonth',
            'usersThisMonth',
            'premiumLastMonth',
            'premiumThisMonth',
            'postsLastMonth',
            'postsThisMonth',
            'reviewsLastMonth',
            'reviewsThisMonth',
        ));
    }

    private function calculateGrowth($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        return (($current - $previous) / $previous) * 100;
    }

    public function restaurant(Request $request)
    {
        $locations = Restaurants::select('location')->distinct()->pluck('location');
        $query = Restaurants::query();

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        if ($request->filled('location') && $request->location !== 'all') {
            $query->where('location', $request->location);
        }

        $restaurants = $query->paginate(5);
        return view('admin.restaurant', compact('restaurants', 'locations'));
    }

    public function badge(Request $request)
    {
        $type = $request->query('type'); // getting query param from URL
        $query = Badge::query();

        if ($type == 'streak') {
            $query->whereNotNull('streak_criteria');
        } elseif ($type == 'contribution') {
            $query->whereNotNull('contribution_required');
        } elseif ($type == 'special') {
            $query->whereNotNull('special_badge');
        }
        $badges = $query->paginate(4);

        // Top 4 users with most badges
        $topUsersByBadge = User::withCount('badges')
            ->orderByDesc('badges_count')
            ->take(4)
            ->get();

        // Getting Top Badge collector: user with the highest number of badges
        $topBadgeCollector = User::withCount('badges')
            ->orderByDesc('badges_count')
            ->first();

        // getting most Badges this month: user with most badges awarded this month
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $mostBadgesThisMonth = User::select('users.*', DB::raw('COUNT(user_badges.user_id) as badge_count'))
            ->join('user_badges', 'users.id', '=', 'user_badges.user_id')
            ->whereBetween('user_badges.awarded_date', [$startOfMonth, $endOfMonth])
            ->groupBy('users.id')
            ->orderByDesc('badge_count')
            ->first();

        // Getting Longest Streak: User with the highest streak_count field
        $longestStreakUser = User::orderByDesc('streak_count')->first();
        return view('admin.badge', compact('badges', 'topBadgeCollector', 'mostBadgesThisMonth', 'longestStreakUser', 'topUsersByBadge'));
    }

    public function tag()
    {
        $tags = Tags::paginate(6);
        return view('admin.tag', compact('tags'));
    }
}
