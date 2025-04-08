<?php

namespace App\Http\Controllers;

use App\Models\CuisineTypes;
use App\Models\FoodPost;
use App\Models\FoodTypes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index()
    {
        $topFoods = FoodPost::orderBy('rating', 'desc')->limit(8)->get();
        $topContributors = User::orderBy('streak_count', 'desc')->take(3)->get();
        return view('FoodiesArchive.index', compact('topFoods', 'topContributors'));
    }
    // public function discover(Request $request)
    // {
    //     $user = auth()->user();
    //     $foodTypes = FoodTypes::all();
    //     $cuisineTypes = CuisineTypes::all();

    //     if ($user) {
    //         // Exclude the authenticated user's posts
    //         $foods = FoodPost::where('user_id', '!=', $user->id)
    //             ->orderBy('created_at', 'desc')
    //             ->paginate(5);

    //         // Exclude authenticated user's followings from top foodies
    //         $topFoodies = User::whereNotIn('id', $user->followings->pluck('id'))
    //             ->where('id', '!=', $user->id)
    //             ->orderBy('streak_count', 'desc')
    //             ->take(5)
    //             ->get();
    //     } else {
    //         // Show all posts for guests
    //         $foods = FoodPost::orderBy('created_at', 'desc')->paginate(5);

    //         // Show top foodies for guests
    //         $topFoodies = User::orderBy('streak_count', 'desc')->take(5)->get();
    //     }

    //     $scrollPosition = $request->input('scroll', 0);

    //     return view('FoodiesArchive.discover', compact('foodTypes', 'cuisineTypes', 'foods', 'topFoodies', 'scrollPosition'));
    // }


    public function discover(Request $request)
    {
        $user = auth()->user();
        $foodTypes = FoodTypes::all();
        $cuisineTypes = CuisineTypes::all();

        $query = FoodPost::query();

        // Exclude authenticated user's posts
        if ($user) {
            $query->where('user_id', '!=', $user->id);
        }

        // Filtering
        if ($request->filled('food_type')) {
            $query->where('food_type_id', $request->food_type);
        }

        if ($request->filled('cuisine_type')) {
            $query->where('cuisine_type_id', $request->cuisine_type);
        }

        // Filtering by Price range
        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }

        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }

        // Filtering by rating
        if ($request->filled('rating')) {
            $query->whereIn('rating', $request->rating);
        }

        // Sorting
        if ($request->filled('sort_by')) {
            switch ($request->sort_by) {
                case 'review':
                    $query->withCount('reviews')->orderByDesc('reviews_count');
                    break;
                case 'newest':
                    $query->orderByDesc('created_at');
                    break;
                case 'most_liked':
                    $query->withCount('likes')->orderByDesc('likes_count');
                    break;
                case 'most_followed_user':
                    // Join the follows table to count followers of the user who posted the food
                    $query->join('users', 'food_posts.user_id', '=', 'users.id')
                        ->leftJoin('follows as f', 'users.id', '=', 'f.followed_id') // Corrected to count followers
                        ->select('food_posts.*', DB::raw('COUNT(f.follower_id) as followers_count'))
                        ->groupBy('food_posts.id', 'users.id') // Ensure to group by both food_posts and users
                        ->orderByDesc('followers_count'); // Order by followers count
                    break;
                default:
                    $query->orderByDesc('created_at');
            }
        } else {
            $query->orderByDesc('created_at');
        }

        $foods = $query->paginate(5)->appends($request->query());

        $topFoodies = $user
            ? User::whereNotIn('id', $user->followings->pluck('id'))
            ->where('id', '!=', $user->id)
            ->orderByDesc('streak_count')->take(5)->get()
            : User::orderByDesc('streak_count')->take(5)->get();

        return view('FoodiesArchive.discover', compact('foodTypes', 'cuisineTypes', 'foods', 'topFoodies'));
    }

    public function following(Request $request)
    {
        // getting the authenticated user
        $user = auth()->user();

        $topFoodies = User::whereNotIn('id', $user->followings->pluck('id'))
            ->where('id', '!=', $user->id) // Excluding the authenticated user
            ->orderBy('streak_count', 'desc')
            ->take(5)
            ->get();

        // getting the latest posts uploaded by users followed by the authenticated user
        $foods = FoodPost::whereIn('user_id', $user->followings->pluck('id'))
            ->latest()
            ->get();

        // Passing the posts to the view
        return view('FoodiesArchive.following', compact('foods', 'topFoodies'));
    }

    public function writeReview()
    {
        $foods = FoodPost::take(4)->get();
        return view('FoodiesArchive.writeReview', compact('foods'));
    }

    // public function postFood()
    // {
    //     return view('FoodiesArchive.postFood');
    // }

    // public function about()
    // {
    //     return view('FoodiesArchive.about');
    // }

    public function bookmark()
    {
        $user = auth()->user();
        $bookmarkedPosts = $user->bookmarksPosts()->orderByPivot('created_at', 'desc')->get();
        return view('FoodiesArchive.bookmark', compact('bookmarkedPosts'));
    }

    public function personalProfile()
    {
        return view('FoodiesArchive.personalProfile');
    }

    public function otherProfile($id)
    {
        $user = User::findOrFail($id);
        return view('FoodiesArchive.otherProfile', compact('user'));
    }
}
