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
            'first_name' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]*$/'],
            'last_name' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]*$/'],
            'username' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]*$/', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $fileName = null;
        if ($request->hasFile('image')) {
            $fileName = Str::slug($request->first_name) . '-' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/'), $fileName);
        }

        // Create a new user with the uploaded data
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $fileName,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
