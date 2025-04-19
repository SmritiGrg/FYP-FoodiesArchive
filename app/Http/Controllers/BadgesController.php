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
                $inputId = 'image-' . $badge->id;
                $previewId = 'badgePreview-' . $badge->id;

                $output .= '
                    <div class="grid grid-cols-9 items-center hover:bg-gray-50 text-center">
                        <div class="col-span-1 font-medium"><img src="' . asset('uploads/badge-images/' . $badge->image) . '" alt="" class="w-28 h-28"></div>
                        <div class="col-span-1 font-medium">' . $badge->name . '</div>
                        <div class="col-span-2 font-medium">' . $badge->description . '</div>
                        <div class="col-span-1">' . $badge->streak_criteria . '</div>
                        <div class="col-span-1">' . $badge->contribution_required . '</div>
                        <div class="col-span-1">' . $badge->special_badge . '</div>
                        <div class="col-span-1">' . $badge->users->count() . '</div>
                        <div class="col-span-1 flex space-x-2 justify-center">
                            <button onclick="openTagEditModal(' . $badge->id . ')" class="text-blue-500">Edit</button>
                            <form action="' . route('badge.delete', $badge->id) . '" method="POST">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="block text-sm font-normal text-red-500 px-2 py-2">Delete</button>
                            </form>
                        </div>
                    </div>
                    <div id="edit-modal-' . $badge->id . '" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 hidden">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
                            <button onclick="closeBadgeEditModal(' . $badge->id . ')" class="absolute top-2 right-2 text-gray-500 hover:text-black text-2xl">
                                <i class=\'fa-solid fa-xmark\'></i>
                            </button>
                            <h2 class="text-xl font-bold mb-4">Edit Badge</h2>
                            <form action="' . route('badge.update', $badge->id) . '" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
                                ' . csrf_field() . method_field('PATCH') . '
                                <div class="flex items-center justify-center text-center relative">
                                    <div class="relative">
                                        <img id="' . $previewId . '" src="' . asset('uploads/badge-images/' . $badge->image) . '" alt="badge" class="object-cover cursor-pointer" style="width: 100px; height: 100px;">
                                        <input type="file" id="' . $inputId . '" name="badge_image" class="hidden" accept="image/*" onchange="previewImage(event, \'' . $previewId . '\')">
                                        <label for="' . $inputId . '" class="absolute top-0 right-0 bg-gray-800 text-white p-1 rounded-full cursor-pointer hover:bg-gray-700 transition" style="width: 30px; height: 30px;">
                                            <i class=\'fa-solid fa-pen\'></i>
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <label class="block font-medium text-sm text-slate-600">Badge Name</label>
                                    <input type="text" name="badge_name" value="' . $badge->name . '" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2">
                                </div>

                                <div>
                                    <label class="block font-medium text-sm text-slate-600">Description</label>
                                    <textarea name="badge_description" class="rounded text-sm border text-slate-400 resize-none w-full h-20 py-2 px-3">' . $badge->description . '</textarea>
                                </div>

                                <div class="flex space-x-2">
                                    <div>
                                        <label class="block font-medium text-sm text-slate-600">Streak Criteria</label>
                                        <input type="text" name="badge_streak_criteria" value="' . $badge->streak_criteria . '" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2">
                                    </div>
                                    <div>
                                        <label class="block font-medium text-sm text-slate-600">Contribution Required</label>
                                        <input type="text" name="badge_contribution_required" value="' . $badge->contribution_required . '" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2">
                                    </div>
                                </div>

                                <div>
                                    <label class="block font-medium text-sm text-slate-600">Special Badge</label>
                                    <input type="text" name="badge_special" value="' . $badge->special_badge . '" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2">
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit" class="bg-customYellow text-white px-4 py-2 rounded hover:bg-hovercustomYellow">Update</button>
                                </div>
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
