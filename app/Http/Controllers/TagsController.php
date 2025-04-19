<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
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
        $tag = new Tags;
        $request->validate([
            'name' => 'required|max:100',
        ]);
        $tag->name = $request->name;
        $tag->save();
        return redirect()->back()->with('message', 'Tag Created Succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tags $tags)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tags $tags)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $tag = Tags::findOrFail($id);
        $request->validate([
            'tag_name' => 'required|max:100',
        ]);
        $tag->name = $request->tag_name;
        $tag->update();
        return redirect()->back()->with('message', 'Tag Updated Succesfully');
    }

    public function searchTag(Request $request)
    {
        $tags = Tags::where('name', 'LIKE', '%' . $request->search . '%')
            ->get();

        $output = '';

        if ($tags->count() > 0) {
            foreach ($tags as $tag) {

                $output .= '
                    <div class="grid grid-cols-8 items-center hover:bg-gray-50 text-center">
                        <div class="col-span-3 font-medium">' . $tag->name . '</div>
                        <div class="col-span-3 font-medium">' . $tag->foodPosts->count() . '</div>
                        <div class="col-span-2 flex space-x-2 justify-center">
                            <button onclick="openTagEditModal(' . $tag->id . ')" class="text-blue-500">Edit</button>
                            <form action="' . route('tag.delete', $tag->id) . '" method="POST">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="block text-sm font-normal text-red-500 px-2 py-2">Delete</button>
                            </form>
                        </div>
                    </div>
                    <div id="edit-modal-' . $tag->id . '" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 hidden">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
                            <button onclick="closeTagEditModal(' . $tag->id . ')" class="absolute top-2 right-2 text-gray-500 hover:text-black text-2xl">
                                <i class=\'fa-solid fa-xmark\'></i>
                            </button>
                            <h2 class="text-xl font-bold mb-4">Edit Tag</h2>
                            <form action="' . route('tag.update', $tag->id) . '" method="POST" class="mt-6 space-y-6">
                                ' . csrf_field() . method_field('PATCH') . '
                                <div>
                                    <label class="block font-medium text-sm text-slate-600">Tag Name</label>
                                    <input type="text" name="tag_name" value="' . $tag->name . '" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2" />
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
            $output .= '<div class="p-4 text-gray-500 text-center">No tags found.</div>';
        }

        return response($output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tag = Tags::query()->where('id', $id)->get()->first();
        $tag->delete();
        return redirect()->back()->with('message', 'Tag Deleted Successfully');
    }
}
