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
                'cloud_name' => config('services.cloudinary.cloud_name'),
                'api_key'    => config('services.cloudinary.api_key'),
                'api_secret' => config('services.cloudinary.api_secret'),
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

        $url = $result['secure_url'];
        
        // Add auto-optimization parameters for images
        if ($resourceType === 'image') {
            $url = str_replace('/upload/', '/upload/f_auto,q_auto/', $url);
        }

        return $url;
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
