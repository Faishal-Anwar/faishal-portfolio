<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cloudinary\Cloudinary;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the user's profile.
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $request->validate([
            'profile_photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $user = Auth::user();

        // Instantiate Cloudinary
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);

        // Delete the old photo from Cloudinary if it exists
        if ($user->profile_photo_url) {
            // Extract the public ID from the old URL
            $urlParts = explode('/', $user->profile_photo_url);
            $publicIdWithExtension = end($urlParts);
            $publicId = pathinfo($publicIdWithExtension, PATHINFO_FILENAME);
            // The folder is the second to last part
            $folder = $urlParts[count($urlParts) - 2];
            if ($folder !== 'upload') { // Check if there is a folder
                $fullPublicId = $folder . '/' . $publicId;
                $cloudinary->uploadApi()->destroy($fullPublicId);
            }
        }

        // Upload the new photo
        $newPhotoUrl = $cloudinary->uploadApi()->upload($request->file('profile_photo')->getRealPath(), [
            'folder' => 'profile-photos'
        ])['secure_url'];

        // Update user record
        $user->profile_photo_url = $newPhotoUrl;
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile photo updated successfully.');
    }
}
