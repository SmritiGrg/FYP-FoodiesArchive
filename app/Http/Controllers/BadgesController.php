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

    public function search(Request $request)
    {
        $badges = Badge::where('name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('streak_criteria', 'LIKE', '%' . $request->search . '%')
            ->orWhere('description', 'LIKE', '%' . $request->search . '%')
            ->orWhere('contribution_required', 'LIKE', '%' . $request->search . '%')
            ->orWhere('special_badge', 'LIKE', '%' . $request->search . '%')
            ->get();

        $output = '';

        if ($badges->count() > 0) {
            foreach ($badges as $badge) {
                $modalId = 'edit-modal-' . $badge->id;

                $output .= '
                    <div class="grid grid-cols-8 items-center hover:bg-gray-50 text-center">
                        <div class="col-span-1 font-medium"><img src="' . asset('uploads/badge-images/' . $badge->image) . '" alt="" class="w-28 h-28"></div>
                        <div class="col-span-1 font-medium">' . $badge->name . '</div>
                        <div class="col-span-2 font-medium">' . $badge->description . '</div>
                        <div class="col-span-1">' . $badge->streak_criteria . '</div>
                        <div class="col-span-1">' . $badge->contribution_required . '</div>
                        <div class="col-span-1">' . $badge->special_badge . '</div>
                        <div class="col-span-1 flex space-x-2 justify-center">
                            <label for="' . $modalId . '" class="block text-sm font-normal text-blue-400 px-2 py-2 cursor-pointer">Edit</label>
                            <form action="' . route('badge.delete', $badge->id) . '" method="POST">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="block text-sm font-normal text-red-500 px-2 py-2">Delete</button>
                            </form>
                        </div>
                    </div>
                ';
            }
        } else {
            $output .= '<div class="p-4 text-gray-500 text-center">No badges found.</div>';
        }

        return response($output);
    }
}
