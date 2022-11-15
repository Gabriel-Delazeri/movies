<?php

declare(strict_types=1);

namespace App\Services;

use App\Utility\Contracts\ImageFilenameInterface;
use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    /**
     * @param string $image
     * @param ImageFilenameInterface $imageFilename
     * @return void
     */
    public function uploadToS3(string $image, ImageFilenameInterface $imageFilename) : void
    {
        $path = Storage::disk('s3')->put($imageFilename->filename, $image);
    }
}
