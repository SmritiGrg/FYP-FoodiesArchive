<?php

namespace App\Http\Controllers;

use App\Models\FoodPost;
use App\Models\ReviewHelpful;
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

    public function helpfulBtn(Reviews $review)
    {
        if (Auth::guest()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $user = Auth::user();

        // \Log::info('Review ID: ' . $review->id);
        // \Log::info('User ID: ' . $user->id);
        // \Log::info('Existing Helpful Query: ' . ReviewHelpful::where('user_id', $user->id)
        //     ->where('review_id', $review->id)
        //     ->toSql());

        // Check if the user already toggled the button
        $existingHelpful = ReviewHelpful::where('user_id', $user->id)
            ->where('review_id', $review->id)
            ->first();

        if ($existingHelpful) {
            // remove helpful 
            $existingHelpful->delete();
            $helpful = false;
        } else {
            // active helpful btn
            ReviewHelpful::create([
                'user_id' => $user->id,
                'review_id' => $review->id
            ]);
            $helpful = true;
        }

        // SENDING JSON response TO THE FRONTEND
        return response()->json([
            'helpful' => $helpful,
            'helpfulCount' => $review->helpfuls()->count()
        ]);
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
