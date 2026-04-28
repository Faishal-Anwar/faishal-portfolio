<?php

namespace App\Helpers;

class CloudinaryHelper
{
    /**
     * Optimize a Cloudinary URL by adding auto-format, auto-quality, and optional width.
     */
    public static function optimize(?string $url, int $width = 0): string
    {
        if (!$url || strpos($url, 'cloudinary.com') === false) {
            return $url ?? '';
        }

        // Already has optimization params
        if (strpos($url, 'f_auto') !== false) {
            return $url;
        }

        $transforms = 'f_auto,q_auto';
        if ($width > 0) {
            $transforms .= ",w_{$width},c_limit";
        }

        return str_replace('/upload/', "/upload/{$transforms}/", $url);
    }
}
