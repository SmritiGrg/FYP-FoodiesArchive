<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('FoodiesArchive.index');
    }
    // public function discover()
    // {
    //     return view('FoodiesArchive.discover');
    // }
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
