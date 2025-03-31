<?php

namespace App\Http\Controllers;

use App\Models\FoodPost;
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
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'review' => 'required|string|min:0|max:100',
    //         'rating' => 'required|integer|min:1|max:5',
    //         'food_post_id' => 'required|exists:food_posts,id',
    //     ]);
    //     $review = new Reviews();
    //     $review->review = $request->review;
    //     $review->rating = $request->rating;
    //     $review->user_id = Auth::user()->id;
    //     $review->food_post_id = $request->food_post_id;
    //     $review->save();
    //     return redirect()->route('personalProfile', ['tab' => 'reviews'])->with('message', 'Review submitted successfully.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'review' => 'required|string|min:1|max:100',
            'food_post_id' => 'required|exists:food_posts,id',
            'parent_id' => 'nullable|exists:reviews,id', // Ensures the parent review exists
            'rating' => 'nullable|integer|min:1|max:5', // Rating is now optional
        ]);

        $review = new Reviews([
            'review' => $request->review,
            'user_id' => Auth::id(),
            'food_post_id' => $request->food_post_id,
            'parent_id' => $request->parent_id,
            'rating' => $request->parent_id ? null : $request->rating, // Only set rating for main reviews
        ]);

        $review->save();

        if ($request->parent_id) {
            return redirect()->back()->with('message', 'Reply submitted successfully.');
        } else {
            return redirect()->route('personalProfile', ['tab' => 'reviews'])->with('message', 'Review submitted successfully.');
        }
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
    public function destroy($id)
    {
        $review = Reviews::query()->where('id', $id)->get()->first();
        $review->delete();
        if ($review->parent_id) {
            $review->delete();
            return redirect()->back()->with('delete', 'Reply deleted successfully!');
        } else {
            $review->delete();
            return redirect()->route('personalProfile', ['tab' => 'reviews'])->with('delete', 'Review deleted successfully!');
        }
    }

    public function writeReview($food_id)
    {
        $foodPost = FoodPost::find($food_id);
        return view('FoodiesArchive.singleReview', compact('foodPost'));
    }
}
