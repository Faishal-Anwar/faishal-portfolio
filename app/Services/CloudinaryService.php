<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

class CloudinaryService
{
    protected $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
            'url' => [
                'secure' => true
            ]
        ]);
    }

    public function upload($file, $folder = 'portfolio')
    {
        $resourceType = 'auto';
        if ($file->getClientOriginalExtension() === 'pdf' || $file->getMimeType() === 'application/pdf') {
            $resourceType = 'raw';
        }

        $result = $this->cloudinary->uploadApi()->upload(
            $file->getRealPath(),
            [
                'folder' => $resourceType === 'raw' ? 'cv' : $folder,
                'resource_type' => $resourceType
            ]
        );

        return $result['secure_url'];
    }

    public function delete($url)
    {
        if (!$url) return;
        
        // Extract public ID from URL
        // Example: https://res.cloudinary.com/demo/image/upload/v1571218039/sample.jpg
        $path = parse_url($url, PHP_URL_PATH);
        if (!$path) return;
        
        $parts = explode('/', $path);
        $filename = end($parts);
        $publicId = pathinfo($filename, PATHINFO_FILENAME);
        
        // If it's in a folder
        $folderIndex = array_search('upload', $parts);
        if ($folderIndex !== false) {
            $publicId = implode('/', array_slice($parts, $folderIndex + 2));
            $publicId = pathinfo($publicId, PATHINFO_FILENAME);
        }

        try {
            // We need to determine resource type for deletion too
            // But Cloudinary destroy defaults to image. For raw, we need to specify.
            $resourceType = (strpos($url, '/raw/') !== false) ? 'raw' : 'image';
            $this->cloudinary->uploadApi()->destroy($publicId, ['resource_type' => $resourceType]);
        } catch (\Exception $e) {
            // Log or ignore
        }
    }
}
