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
        $topFoods = FoodPosts::orderBy('rating', 'desc')->limit(4)->get();
        $topContributors = User::orderBy('streak_count', 'desc')->take(3)->get();
        return view('FoodiesArchive.index', compact('topFoods', 'topContributors'));
    }
    public function discover()
    {
        $foodTypes = FoodTypes::all();
        $cuisineTypes = CuisineTypes::all();
        $foods = FoodPosts::orderBy('created_at', 'desc')->get();
        return view('FoodiesArchive.discover', compact('foodTypes', 'cuisineTypes', 'foods'));
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
}
