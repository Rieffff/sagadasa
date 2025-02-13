<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageHelper
{
    public static function uploadAndResize($file,$arr,$status, $path = 'reportImg', $width = 294, $height = 390, $quality = 75)
    {
        if (!$file || !$file->isValid()) {
            return null;
        }

        // Buat instance ImageManager dengan driver GD
        $manager = new ImageManager(new Driver());

        // Generate nama file unik
        $filename = $status.'-'. date('Ymd-His') .'-'.$arr. '.' . $file->getClientOriginalExtension();

        // Baca file dari request
        $image = $manager->read($file->getRealPath());

        // Resize dengan mempertahankan aspect ratio
        $image->resize(height: $height);
        $image->resize(width: $width);

        // Encode sebagai JPG dengan kualitas tertentu
        $encoded = $image->toJpg(quality: $quality);

        // Simpan ke storage Laravel (public disk = storage/app/public)
        Storage::disk('public')->put("{$path}/{$filename}", (string) $encoded);

        return $filename;
    }
}
