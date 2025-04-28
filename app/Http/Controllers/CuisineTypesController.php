<?php

namespace App\Http\Controllers;

use App\Models\CuisineTypes;
use Illuminate\Http\Request;

class CuisineTypesController extends Controller
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
        $cuisine = new CuisineTypes();
        $request->validate([
            'name' => 'required|max:100',
        ]);
        $cuisine->name = $request->name;
        $cuisine->save();
        return redirect()->back()->with('message', 'Cuisine Created Succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CuisineTypes $cuisineTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CuisineTypes $cuisineTypes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $cuisine = CuisineTypes::findOrFail($id);
        $request->validate([
            'cuisine_name' => 'required|max:100',
        ]);
        $cuisine->name = $request->cuisine_name;
        $cuisine->update();
        return redirect()->back()->with('message', 'Cuisine Updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cuisine = CuisineTypes::query()->where('id', $id)->get()->first();
        $cuisine->delete();
        return redirect()->back()->with('message', 'Cuisine Deleted Successfully');
    }
}
