<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TheMovieDBImagesService
{
    /**
     * @param string $imagePath
     * @return string
     */
    public function getMovieImage(string $imagePath) : string
    {
        return Http::themoviedatabaseimages()
            ->get('/'.$imagePath)
            ->getBody()
            ->getContents();
    }
}
