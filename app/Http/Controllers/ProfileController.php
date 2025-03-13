<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // dd($request);
        $request->user()->fill($request->validated());

        // Check if an image was uploaded
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Delete the old image if it exists
            $oldImage = $request->user()->image;
            if ($oldImage && file_exists(public_path('uploads/profile-images/' . $oldImage))) {
                unlink(public_path('uploads/profile-images/' . $oldImage));
            }

            // Create a new file name
            $fileName = Str::slug($request->user()->username) . '-profile-' . time() . '.' . $request->image->extension();

            // Move the uploaded image to the 'uploads' directory
            $request->image->move(public_path('uploads/profile-images/'), $fileName);

            // Update the user's image path
            $request->user()->image = $fileName;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function removeImage(Request $request)
    {
        // $user = auth()->user();
        $user = Auth::user();

        // Remove the current image if it exists
        if ($user->image && file_exists(public_path('uploads/profile-images/' . $user->image))) {
            unlink(public_path('uploads/profile-images/' . $user->image));
        }

        if ($user instanceof User) {
            $user->save();
        }

        return redirect()->route('profile.edit')->with('status', 'Profile picture removed.');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();

        return Redirect::to('/');
    }
}
