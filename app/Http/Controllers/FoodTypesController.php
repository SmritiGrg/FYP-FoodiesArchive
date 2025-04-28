<?php

namespace App\Http\Controllers;

use App\Models\FoodTypes;
use Illuminate\Http\Request;

class FoodTypesController extends Controller
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
        $foodtype = new FoodTypes();
        $request->validate([
            'foodtypeadd_name' => 'required|max:100',
        ]);
        $foodtype->name = $request->foodtypeadd_name;
        $foodtype->save();
        return redirect()->back()->with('message', 'Foodtype Created Succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodTypes $foodTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodTypes $foodTypes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $foodtype = FoodTypes::findOrFail($id);
        $request->validate([
            'foodtype_name' => 'required|max:100',
        ]);
        $foodtype->name = $request->foodtype_name;
        $foodtype->update();
        return redirect()->back()->with('message', 'Foodtype Updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $foodtype = FoodTypes::query()->where('id', $id)->get()->first();
        $foodtype->delete();
        return redirect()->back()->with('message', 'Food Type Deleted Successfully');
    }
}
