<?php

namespace App\Http\Controllers;

use App\Models\Follows;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
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

    public function follow(User $user)
    {
        $follower = auth()->user();
        $follower->followings()->attach($user);
        return back()->with('success', "Followed successfully!");
    }

    public function unfollow(User $user)
    {
        $follower = auth()->user();
        $follower->followings()->detach($user);
        return back()->with('success', "Unfollowed successfully!");
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
    public function show(Follows $follows)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Follows $follows)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Follows $follows)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Follows $follows)
    {
        //
    }
}
