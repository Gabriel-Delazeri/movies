<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    public function uploadToS3(string $image, string $filename) : string
    {
        $imageName = $filename.time().'.png';

        $path = Storage::disk('s3')->url($imageName);
        $path = Storage::disk('s3')->put($imageName, $image);

        return $imageName;
    }
}
