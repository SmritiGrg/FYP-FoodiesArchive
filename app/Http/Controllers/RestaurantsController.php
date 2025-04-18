<?php

namespace App\Http\Controllers;

use App\Models\Restaurants;
use Illuminate\Http\Request;

class RestaurantsController extends Controller
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
        $restaurant = new Restaurants();
        $request->validate([
            'name' => 'required|max:100',
            'location' => 'required',
            'longitude' => 'numeric|nullable',
            'latitude' => 'numeric|nullable',
            'status' => 'nullable',
            'added_by_user_id' => 'required',
        ]);
        $restaurant->name = $request->name;
        $restaurant->location = $request->location;
        $restaurant->latitude = $request->latitude;
        $restaurant->longitude = $request->longitude;
        $restaurant->status = $request->status;
        $restaurant->added_by_user_id = $request->added_by_user_id;
        $restaurant->save();
        return redirect()->back()->with('message', 'Restaurant Added Succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurants $restaurants)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurants $restaurants)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $restaurant = Restaurants::findOrFail($id);
        $request->validate([
            'rest_name' => 'required|max:100',
            'rest_location' => 'required',
            'rest_longitude' => 'nullable',
            'rest_latitude' => 'nullable',
            'rest_status' => 'required',
            'added_by_user_id' => 'required',
        ]);
        $restaurant->name = $request->rest_name;
        $restaurant->location = $request->rest_location;
        $restaurant->latitude = $request->rest_latitude;
        $restaurant->longitude = $request->rest_longitude;
        $restaurant->status = $request->rest_status;
        $restaurant->added_by_user_id = $request->added_by_user_id;
        $restaurant->update();
        return redirect()->back()->with('message', 'Restaurant Updated Succesfully');
    }

    public function approve($id)
    {
        $restaurant = Restaurants::findOrFail($id);
        $restaurant->status = 'approved';
        $restaurant->save();

        return redirect()->back()->with('message', 'Restaurant approved successfully!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $restaurant = Restaurants::query()->where('id', $id)->get()->first();
        $restaurant->delete();
        return redirect()->back()->with('message', 'Restaurant Deleted Successfully');
    }
}
