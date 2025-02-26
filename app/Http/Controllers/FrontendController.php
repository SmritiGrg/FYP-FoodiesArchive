<?php

namespace App\Http\Controllers;

use App\Models\CuisineTypes;
use App\Models\FoodPosts;
use App\Models\FoodTypes;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $topFoods = FoodPosts::orderBy('rating', 'desc')->limit(4)->get();
        return view('FoodiesArchive.index', compact('topFoods'));
    }
    public function discover()
    {
        $foodTypes = FoodTypes::all();
        $cuisineTypes = CuisineTypes::all();
        $foods = FoodPosts::orderBy('created_at', 'desc')->get();
        return view('FoodiesArchive.discover', compact('foodTypes', 'cuisineTypes', 'foods'));
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
}
