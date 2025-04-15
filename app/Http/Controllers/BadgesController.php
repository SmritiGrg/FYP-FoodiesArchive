<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BadgesController extends Controller
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
        // dd($request);
        $badge = new Badge;
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'name' => 'required|max:100|unique:badges,name',
            'description' => 'required|max:100',
            'streak_criteria' => 'nullable|numeric|min:5',
            'contribution_required' => 'nullable|numeric|min:0',
            'special_badge' => 'nullable|string|max:155',
        ]);
        if ($request->hasFile('image')) {
            $fileName = Str::slug($request->name) . '-' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/badge-images/'), $fileName);
            $badge->image = $fileName;
        }
        $badge->name = $request->name;
        $badge->description = $request->description;
        $badge->streak_criteria = $request->streak_criteria;
        $badge->contribution_required = $request->contribution_required;
        $badge->special_badge = $request->special_badge;

        $badge->save();
        return redirect()->back()->with('message', 'Badge Created Succesfully');
        // if ($badge->save()) {
        //     dd('Saved!');
        // } else {
        //     dd('Save failed');
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Badge $badges)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Badge $badges)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $badge = Badge::findOrFail($id);
        $request->validate([
            'badge_image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'badge_name' => 'required|max:100',
            'badge_description' => 'nullable|max:100',
            'badge_streak_criteria' => 'nullable|numeric|min:5',
            'badge_contribution_required' => 'nullable|numeric|min:0',
            'badge_special' => 'nullable|string|max:155',
        ]);
        if ($request->hasFile('badge_image')) {
            $fileName = Str::slug($request->badge_name) . '-' . time() . '.' . $request->badge_image->extension();
            $request->badge_image->move(public_path('uploads/badge-images/'), $fileName);
            $badge->image = $fileName;
        }
        $badge->name = $request->badge_name;
        $badge->description = $request->badge_description;
        $badge->streak_criteria = $request->badge_streak_criteria;
        $badge->contribution_required = $request->badge_contribution_required;
        $badge->special_badge = $request->badge_special;
        $badge->update();
        return redirect()->back()->with('message', 'Badge Updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $badge = Badge::query()->where('id', $id)->get()->first();
        $badge->delete();
        return redirect()->back()->with('message', 'Badge Deleted Successfully');
    }
}
