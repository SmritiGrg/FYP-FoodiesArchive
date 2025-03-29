<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FoodPost;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function store(FoodPost $foodPost)
    {
        $user = Auth::user();

        if ($user->bookmarksPosts()->where('food_post_id', $foodPost->id)->exists()) {
            $user->bookmarksPosts()->detach($foodPost->id);
            return response()->json(['bookmarked' => false]);
        } else {
            $user->bookmarksPosts()->attach($foodPost->id);
            return response()->json(['bookmarked' => true]);
        }
    }
}
