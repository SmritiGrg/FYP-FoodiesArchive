<?php

namespace App\Http\Controllers;

use App\Models\CuisineTypes;
use App\Models\FoodPosts;
use App\Models\FoodTypes;
use App\Models\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $topFoods = FoodPosts::orderBy('rating', 'desc')->limit(8)->get();
        $topContributors = User::orderBy('streak_count', 'desc')->take(3)->get();
        return view('FoodiesArchive.index', compact('topFoods', 'topContributors'));
    }
    public function discover(Request $request)
    {
        $user = auth()->user();
        $foodTypes = FoodTypes::all();
        $cuisineTypes = CuisineTypes::all();

        $foods = FoodPosts::where('user_id', '!=', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $topFoodiesGuest = User::orderBy('streak_count', 'desc')->take(5)->get();
        $topFoodiesAuth = User::whereNotIn('id', $user->followings->pluck('id'))
            ->where('id', '!=', $user->id) // Excluding the authenticated user
            ->orderBy('streak_count', 'desc')
            ->take(5)
            ->get();

        $scrollPosition = $request->input('scroll', 0);

        return view('FoodiesArchive.discover', compact('foodTypes', 'cuisineTypes', 'foods', 'topFoodiesGuest', 'topFoodiesAuth', 'scrollPosition'));
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
        $foods = FoodPosts::whereIn('user_id', $user->followings->pluck('id'))
            ->latest()
            ->get();

        // Passing the posts to the view
        return view('FoodiesArchive.following', compact('foods', 'topFoodies'));
    }

    public function writeReview()
    {
        $foods = FoodPosts::take(4)->get();
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
        return view('FoodiesArchive.bookmark');
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
