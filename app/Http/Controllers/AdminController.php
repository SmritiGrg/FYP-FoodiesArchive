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
use Illuminate\Pagination\LengthAwarePaginator;

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

        // Getting top 4 users with most badges
        $topUsersByBadge = User::withCount('badges')
            ->orderByDesc('badges_count')
            ->take(4)
            ->get();

        // Getting top Badge collector: user with the highest number of badges
        $topBadgeCollector = User::withCount('badges')
            ->orderByDesc('badges_count')
            ->first();

        // Getting most Badges this month: user with most badges awarded this month
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

        ///////// CHART LOGIC STARTS ///////////
        // Getting most earned badges
        $mostEarned = Badge::withCount('users')
            ->orderByDesc('users_count')
            ->take(5)
            ->get();

        // Getting least earned badges
        $leastEarned = Badge::withCount('users')
            ->orderBy('users_count')
            ->take(5)
            ->get();

        // Getting Top Users by Total Badges
        $topUsers = User::withCount('badges')
            ->orderByDesc('badges_count')
            ->take(5)
            ->get();

        // Getting Most Common Badge Type
        $allBadges = Badge::all();
        $badgeTypeCounts = [
            'Streaks' => $allBadges->filter(fn($b) => !is_null($b->streak_criteria))->count(),
            'Contributions' => $allBadges->filter(fn($b) => !is_null($b->contribution_required))->count(),
            'Special' => $allBadges->filter(fn($b) => !is_null($b->special_badge))->count(),
        ];


        return view('admin.badge', compact(
            'badges',
            'topBadgeCollector',
            'mostBadgesThisMonth',
            'longestStreakUser',
            'topUsersByBadge',
            'mostEarned',
            'leastEarned',
            'topUsers',
            'badgeTypeCounts'
        ));
    }

    public function tag()
    {
        $filter = request('filter');
        $perPage = 6;
        $page = request()->get('page', 1);

        // Getting all tags with count
        $allTags = Tags::withCount('foodPosts')->get();

        if ($filter === 'most') {
            $sorted = $allTags->sortByDesc('food_posts_count')->values();
        } elseif ($filter === 'least') {
            $sorted = $allTags->sortBy('food_posts_count')->values();
        } else {
            $tags = Tags::withCount('foodPosts')->paginate($perPage); // normal paginate
        }

        // If sorted exists, manually paginate it
        if (isset($sorted)) {
            $tags = new LengthAwarePaginator(
                $sorted->forPage($page, $perPage),
                $sorted->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        }

        // Top 10 Most Used Tags
        $topTags = $allTags->sortByDesc('food_posts_count')->take(10);

        // Tags Never Used
        $unusedTags = $allTags->filter(fn($tag) => $tag->food_posts_count == 0);

        // Trending Tags This Week
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $weekTrending = Tags::withCount(['foodPosts' => function ($query) use ($startOfWeek, $endOfWeek) {
            $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
        }])->orderByDesc('food_posts_count')->take(5)->get();

        // Trending Tags This Month
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $monthTrending = Tags::withCount(['foodPosts' => function ($query) use ($startOfMonth, $endOfMonth) {
            $query->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
        }])->orderByDesc('food_posts_count')->take(5)->get();

        return view('admin.tag', compact('tags', 'topTags', 'unusedTags', 'weekTrending', 'monthTrending', 'filter'));
    }
}
