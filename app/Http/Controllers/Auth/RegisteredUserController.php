<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'full_name' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s\-\'\.]+$/'],
            'username' => ['required', 'string', 'max:20', 'regex:/^(?=.*[a-zA-Z])[\w\-.]*$/', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create a new user with the uploaded data
        $user = User::create([
            'full_name' => $request->full_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // event(new Registered($user));

        Auth::login($user);

        session()->flash('showProfileImageModal', true);

        // return redirect(route('dashboard', absolute: false));
        return redirect('/')->with('status', 'Registration successful! You are now logged in.');
    }

    public function storeProfileImage(Request $request)
    {
        // dd($request);
        // Validate the incoming request
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        // Get the currently authenticated user
        $user = Auth::user();

        // Check if an image was uploaded
        if ($request->hasFile('image')) {
            // Generate a unique filename
            $fileName = Str::slug($user->username) . '-profile-' . time() . '.' . $request->image->extension();

            // Move the uploaded file to the uploads directory
            $request->image->move(public_path('uploads/profile-images/'), $fileName);

            // Update the user's profile image in the database
            if ($user instanceof User) {
                $user->update(['image' => $fileName]);
            }

            // Redirect with success message
            return redirect('/')->with('status', 'Profile image uploaded successfully!');
        }

        // Redirect with error if no image was uploaded
        return redirect()->back()->with('error', 'No image was uploaded.');
    }
}
