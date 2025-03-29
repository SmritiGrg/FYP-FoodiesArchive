<?php

namespace App\Http\Controllers;

use App\Models\CuisineTypes;
use App\Models\FoodPost;
use App\Models\FoodTypes;
use App\Models\Restaurants;
use App\Models\Reviews;
use App\Models\Tags;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FoodPostController extends Controller
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
    public function create($step = 1)
    {
        // Store total steps in session
        Session::put('totalSteps', 6);

        // Ensure the step does not exceed limits
        $currentStep = max(1, min($step, Session::get('totalSteps', 6)));

        $restaurants = Restaurants::all();
        $foodtypes = FoodTypes::all();
        $cuisinetypes = CuisineTypes::all();
        $tags = Tags::all();
        return view('FoodiesArchive.postFood', compact('restaurants', 'foodtypes', 'cuisinetypes', 'tags', 'currentStep'));
    }

    public function nextStep(Request $request)
    {
        $currentStep = $request->session()->get('currentStep', 1);
        $totalSteps = $request->session()->get('totalSteps', 6);

        // Validate data based on the step
        $this->validateStep($request, $currentStep);

        // Store the current step data into session
        if ($currentStep == 1) {
            $request->session()->put('name', $request->input('name'));
            $request->session()->put('price', $request->input('price'));
            $request->session()->put('restaurant_id', $request->input('restaurant_id'));
        } elseif ($currentStep == 2) {
            $request->session()->put('cuisine_type_id', $request->input('cuisine_type_id'));
        } elseif ($currentStep == 3) {
            $request->session()->put('food_type_id', $request->input('food_type_id'));
        } elseif ($currentStep == 4) {
            $request->session()->put('tag_id', $request->input('tag_id'));
        } elseif ($currentStep == 5) {
            $request->validate([
                'image' => $request->session()->has('image') ? 'nullable|image|mimes:jpeg,png,jpg|max:2048' : 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');

                // Delete the previous image if it exists
                if ($request->session()->has('image')) {
                    $oldImagePath = public_path($request->session()->get('image'));
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $foodName = Str::slug($request->session()->get('name'));
                // Generate a new filename
                $filename = "food_img_{$foodName}_" . time() . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('food_img'), $filename);

                // Store only the relative path in session
                $request->session()->put('image', 'food_img/' . $filename);
            }
        }
        // dd('Before Increment:', $request);
        $this->validateStep($request,  $currentStep);
        // Increase step
        $currentStep++;
        if ($currentStep > $totalSteps) {
            $currentStep = $totalSteps;
        }

        $request->session()->put('currentStep', $currentStep);
        return redirect()->route('foodpost.create', ['step' => $currentStep]);
    }

    public function previousStep(Request $request)
    {
        $currentStep = $request->session()->get('currentStep', 1);

        // Decrease step
        $currentStep--;
        if ($currentStep < 1) {
            $currentStep = 1;
        }

        $request->session()->put('currentStep', $currentStep);
        return redirect()->route('foodpost.create', ['step' => $currentStep]);
    }

    private function validateStep(Request $request, $step)
    {
        $rules = [];

        if ($step == 1) {
            $rules = [
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:20.01',
                'restaurant_id' => 'required',
            ];
        } elseif ($step == 2) {
            $rules = [
                'cuisine_type_id' => 'required',
            ];
        } elseif ($step == 3) {
            $rules = [
                'food_type_id' => 'required',
            ];
        } elseif ($step == 4) {
            $rules = [
                'tag_id' => 'required',
            ];
        } elseif ($step == 5) {
            $rules = [
                'image' => $request->session()->has('image')
                    ? 'nullable' // Image is optional if already in session
                    : 'required' // Image is required if not in session
            ];
        }
        $request->validate($rules);
    }

    public function store(Request $request)
    {
        // Get all session data for the food post
        // dd($request);
        $request->validate([
            'review' => 'required|string|min:0|max:100',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $data = [
            'name' => $request->session()->get('name'),
            'price' => $request->session()->get('price'),
            'restaurant_id' => $request->session()->get('restaurant_id'),
            'cuisine_type_id' => $request->session()->get('cuisine_type_id'),
            'food_type_id' => $request->session()->get('food_type_id'),
            'tag_id' => $request->session()->get('tag_id'),
            'image' => $request->session()->get('image'),
        ];

        // dd($request);
        // Create new food post
        $foodPost = new FoodPost();

        // Store the rest of the form data
        $foodPost->name = $data['name'];
        $foodPost->price = $data['price'];
        $foodPost->review = $request->review;
        $foodPost->rating = $request->rating;
        $foodPost->restaurant_id = $data['restaurant_id'];
        $foodPost->cuisine_type_id = $data['cuisine_type_id'];
        $foodPost->food_type_id = $data['food_type_id'];
        $foodPost->tag_id = $data['tag_id'];
        $foodPost->image = $data['image'];
        $foodPost->user_id = Auth::user()->id;

        // Save to database
        $foodPost->save();

        // Clear session data after successful submission
        $request->session()->forget(['currentStep', 'totalSteps', 'name', 'price', 'restaurant_id', 'cuisine_type_id', 'food_type_id', 'tag_id', 'image', 'review', 'rating']);

        return redirect()->route('personalProfile')->with('message', 'Post uploaded successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        $food = FoodPost::findOrFail($id);

        if ($request->has('scroll')) {
            session(['scroll_position' => $request->scroll]);
        }

        $reviewsPaginate = Reviews::where('food_post_id', $id)->paginate(5);

        $similarPosts = FoodPost::where('id', '!=', $id)
            ->where('user_id', '!=', Auth::id()) // Excluding posts from the auth user
            ->where(function ($query) use ($food) {
                $query->where('cuisine_type_id', $food->cuisine_type_id)
                    ->orWhere('food_type_id', $food->food_type_id)
                    ->orWhere('name', 'LIKE', '%' . $food->name . '%');
            })
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('FoodiesArchive.singlePost', compact('food', 'similarPosts', 'reviewsPaginate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodPost $foodPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FoodPost $foodPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodPost $foodPost)
    {
        //
    }

    public function search(Request $request)
    {
        $foodTypes = FoodTypes::all();
        $cuisineTypes = CuisineTypes::all();

        $search = $request->input('query');

        $result = FoodPost::where(function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
            ->orWhereHas('cuisineType', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->orWhereHas('foodType', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->orWhereHas('tag', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->orWhereHas('restaurant', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->get();

        $users = User::where('full_name', 'LIKE', "%$search%")
            ->orWhere('username', 'LIKE', "%$search%")
            ->get();

        return view('FoodiesArchive.search', compact('result', 'users', 'search', 'foodTypes', 'cuisineTypes'));
    }

    // Call this method to cancel the multistep form
    public function clearFormSession(Request $request)
    {
        // Forget all form data related to this food post process
        $request->session()->forget([
            'currentStep',
            'totalSteps',
            'name',
            'price',
            'restaurant_id',
            'cuisine_type_id',
            'food_type_id',
            'tag_id',
            'review',
            'rating',
            'image'
        ]);

        return redirect()->route('foodpost.create')->with('message', 'Form data has been cleared.');
    }
}
