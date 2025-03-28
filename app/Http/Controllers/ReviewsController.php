<?php

namespace App\Http\Controllers;

use App\Models\FoodPosts;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewsController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'review' => 'required|string|min:0|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'food_post_id' => 'required|exists:food_posts,id',
        ]);
        $review = new Reviews();
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->user_id = Auth::user()->id;
        $review->food_post_id = $request->food_post_id;
        $review->save();
        return redirect()->route('personalProfile', ['tab' => 'reviews'])->with('message', 'Review submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reviews $reviews)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reviews $reviews)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reviews $reviews)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reviews $reviews)
    {
        //
    }

    public function writeReview($food_id)
    {
        $foodPost = FoodPosts::find($food_id);
        return view('FoodiesArchive.singleReview', compact('foodPost'));
    }
}
