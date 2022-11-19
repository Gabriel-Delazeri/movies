<?php

namespace App\Jobs;

use App\Services\ImageUploadService;
use App\Services\TheMovieDBImagesService;
use App\Utility\Contracts\ImageFilenameInterface;
use App\Utility\PosterFilename;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UploadTMDBImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        protected ImageFilenameInterface $imageFilename,
        protected string $imagePath,
    )
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() : void
    {
        $theMovieDBImageService = new TheMovieDBImagesService();
        $image = $theMovieDBImageService->getMovieImage($this->imagePath);

        $imageUploadService = new ImageUploadService();
        $imageUploadService->uploadToS3($image, $this->imageFilename);
    }
}
