<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::pluck('value', 'key')->all();
        return view('settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'contact_email' => 'nullable|email',
            'linkedin_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cv_file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Handle text-based settings
        $textSettings = ['contact_email', 'linkedin_url', 'instagram_url', 'github_url'];
        foreach ($textSettings as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(['key' => $key], ['value' => $request->input($key)]);
            }
        }

        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);

        // Handle Profile Photo Upload
        if ($request->hasFile('profile_photo')) {
            $this->handleFileUpload('profile_photo_url', $request->file('profile_photo'), $cloudinary, 'profile-photos', 'image');
        }

        // Handle CV File Upload
        if ($request->hasFile('cv_file')) {
            $this->handleFileUpload('cv_url', $request->file('cv_file'), $cloudinary, 'cv-files', 'raw');
        }

        // Clear the settings cache
        Cache::forget('site.settings');

        return redirect()->route('settings.edit')->with('success', 'Settings updated successfully.');
    }

    private function handleFileUpload($key, $file, $cloudinary, $folder, $resourceType = 'image')
    {
        // Delete old file if it exists
        $oldUrlSetting = Setting::find($key);
        if ($oldUrlSetting && $oldUrlSetting->value) {
            try {
                $urlParts = explode('/', $oldUrlSetting->value);
                $publicIdWithExtension = end($urlParts);
                $publicId = pathinfo($publicIdWithExtension, PATHINFO_FILENAME);
                
                // Determine the folder from the URL
                $folderName = '';
                if (count($urlParts) > 2) {
                    $folderName = $urlParts[count($urlParts) - 2];
                }

                if ($folderName && $folderName !== 'upload') {
                    $fullPublicId = $folderName . '/' . $publicId;
                    $cloudinary->uploadApi()->destroy($fullPublicId, ['resource_type' => $resourceType]);
                }
            } catch (\Exception $e) {
                // Log error or handle failed deletion
            }
        }

        // Upload new file
        $newUrl = $cloudinary->uploadApi()->upload($file->getRealPath(), [
            'folder' => $folder,
            'resource_type' => $resourceType
        ])['secure_url'];

        // Save new URL to settings
        Setting::updateOrCreate(['key' => $key], ['value' => $newUrl]);
    }

    public function downloadCv()
    {
        $cvUrl = Setting::find('cv_url')->value ?? null;

        if (!$cvUrl) {
            abort(404, 'CV not found.');
        }

        return response()->streamDownload(function () use ($cvUrl) {
            echo file_get_contents($cvUrl);
        }, 'CV-Faishal-Anwar.pdf');
    }
}
