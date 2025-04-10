<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\FoodPost;
use App\Models\Restaurants;
use App\Models\Reviews;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

    public function restaurant()
    {
        $restaurants = Restaurants::paginate(5);
        return view('admin.restaurant', compact('restaurants'));
    }

    public function badge()
    {
        $badges = Badge::paginate(5);
        return view('admin.badge', compact('badges'));
    }
}
