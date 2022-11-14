<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TheMovieDBService
{
    public function getPopularMovies()
    {
        return Http::themoviedatabase()
            ->get('/movie/popular?api_key=' . config('tmdb.key') . '&language=en-US&page')
            ->json();
    }
}
