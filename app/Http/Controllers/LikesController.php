<?php

namespace App\Http\Controllers;

use App\Models\FoodPost;
use App\Models\Likes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Likes $likes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Likes $likes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Likes $likes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Likes $likes)
    {
        //
    }

    public function like(FoodPost $foodPost)
    {
        if (Auth::guest()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $user = Auth::user();

        // Check if the user already liked the post
        $existingLike = Likes::where('user_id', $user->id)
            ->where('food_post_id', $foodPost->id)
            ->first();

        if ($existingLike) {
            // Unlike the post
            $existingLike->delete();
            $liked = false;
        } else {
            // Like the post
            Likes::create([
                'user_id' => $user->id,
                'food_post_id' => $foodPost->id
            ]);
            $liked = true;

            // Checking and assigning like-related badge to the owner of the post
            $postOwner = $foodPost->user;
            $badge = $this->checkForLikeBasedBadges($postOwner);
            // dd($badge, $postOwner);
            // dd($badge);
            logger('Returned badge:', [$badge]);

            if ($badge) {
                // Store badge popup in the database for the post owner
                $postOwner->update([
                    'badge_popup' => [
                        'name' => $badge->name,
                        'description' => $badge->description,
                        'image' => $badge->image,
                    ],
                ]);
            }
        }

        // SENDING JSON response TO THE FRONTEND
        return response()->json([
            'liked' => $liked,
            'likeCount' => $foodPost->likes()->count()
        ]);
    }
}
