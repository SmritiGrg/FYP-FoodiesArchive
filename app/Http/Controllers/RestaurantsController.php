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
        return view('admin.create');
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
            'status' => 'nullable',
            'added_by_user_id' => 'required',
            'map_embed_url' => 'nullable',
        ]);
        $restaurant->name = $request->name;
        $restaurant->location = $request->location;
        $restaurant->status = $request->status ?? 'pending';
        $restaurant->added_by_user_id = $request->added_by_user_id;
        $restaurant->map_embed_url = $request->map_embed_url;
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
            'rest_status' => 'required',
            'added_by_user_id' => 'required',
            'map_embed_url' => 'required',
        ]);
        $restaurant->name = $request->rest_name;
        $restaurant->location = $request->rest_location;
        $restaurant->status = $request->rest_status;
        $restaurant->added_by_user_id = $request->added_by_user_id;
        $restaurant->map_embed_url = $request->map_embed_url;
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

    public function searchRestaurant(Request $request)
    {
        $restaurants = Restaurants::where('name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('location', 'LIKE', '%' . $request->search . '%')
            ->orWhere('status', 'LIKE', '%' . $request->search . '%')
            ->get();

        $output = '';

        if ($restaurants->count() > 0) {
            foreach ($restaurants as $restaurant) {
                // Use Blade component and render it to a string
                $output .= view('components.restaurant-row', compact('restaurant'))->render();
            }
        } else {
            $output .= '<div class="p-4 text-gray-500 text-center">No restaurant found.</div>';
        }

        return response($output);
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
