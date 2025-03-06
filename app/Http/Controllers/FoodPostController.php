<?php

namespace App\Http\Controllers;

use App\Models\CuisineTypes;
use App\Models\FoodPosts;
use App\Models\FoodTypes;
use App\Models\Restaurants;
use App\Models\Tags;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class FoodPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $restaurants = Restaurants::all();
        $foodtypes = FoodTypes::all();
        $cuisinetypes = CuisineTypes::all();
        $tags = Tags::all();
        return view('FoodiesArchive.postFood', compact('restaurants', 'foodtypes', 'cuisinetypes', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

        $foodPost = new FoodPosts();
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'review' => 'required|string|max:100',
            'restaurant_id' => 'required',
            'cuisine_type_id' => 'required',
            'food_type_id' => 'required',
            'tag_id' => 'required',

        ]);

        $fileName = Str::slug($request->name) . '-' . time() . '.' . $request->image->extension();
        $request->file('image')->move(public_path('uploads/'), $fileName);
        $foodPost->image = $fileName;
        $foodPost->rating = $request->rating ?? 0; // Default to 0 if no rating is provided

        $foodPost->name = $request->name;
        $foodPost->price = $request->price;
        $foodPost->review = $request->review;
        $foodPost->restaurant_id = $request->restaurant_id;
        $foodPost->cuisine_type_id = $request->cuisine_type_id;
        $foodPost->food_type_id = $request->food_type_id;
        $foodPost->tag_id = $request->tag_id;
        $foodPost->user_id = Auth::user()->id;
        $foodPost->save();
        return redirect('/')->with('message', 'Post uploaded Succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodPosts $foodPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodPosts $foodPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FoodPosts $foodPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodPosts $foodPost)
    {
        //
    }

    public function search(Request $request)
    {
        $foodTypes = FoodTypes::all();
        $cuisineTypes = CuisineTypes::all();

        $search = $request->input('query');

        $result = FoodPosts::where(function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
            ->orWhereHas('cuisineType', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->orWhereHas('foodType', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->orWhereHas('tag', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->orWhereHas('restaurant', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->get();

        $users = User::where('full_name', 'LIKE', "%$search%")
            ->orWhere('username', 'LIKE', "%$search%")
            ->get();

        return view('FoodiesArchive.search', compact('result', 'users', 'search', 'foodTypes', 'cuisineTypes'));
    }
}
