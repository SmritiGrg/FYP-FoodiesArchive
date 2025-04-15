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
