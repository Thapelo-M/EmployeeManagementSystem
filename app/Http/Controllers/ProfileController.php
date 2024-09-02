<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models;
use Illuminate\Support\Facades\Storage;

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
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updateProfile(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();

        // Check if the request contains a file
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');

            // Check if the file is valid
            if ($image->isValid()) {
                // Create a unique image name
                $imageName = 'image-' . time() . rand(1, 1000) . '.' . $image->extension();

                try {
                    // Store the image in directory
                    $imagePath = $image->store('public/userPictures');

                    // Update the profile picture path
                    $user->profile_pic = basename($imagePath);

                    // Save the user and check if the profile_pic field updates
                    if ($request->user()->save()) {
                        return redirect()->route('profile.edit')->with('success', 'Profile was updated successfully');
                    } else {
                        return redirect()->route('profile.edit')->with('error', 'Failed to update the profile picture in the database.');
                    }
                } catch (\Exception $e) {
                    // Log the error or handle it appropriately
                    return redirect()->route('profile.edit')->with('error', 'Failed to upload image: ' . $e->getMessage());
                }
            } else {
                return redirect()->route('profile.edit')->with('error', 'Uploaded file is not valid.');
            }
        } else {
            return redirect()->route('profile.edit')->with('error', 'No image was uploaded.');
        }
        }



    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
