<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TheMovieDBService
{
    /**
     * @param string $page
     * @return array
     */
    public function getPopularMovies(string $page = "1") : array
    {
        return Http::themoviedatabase()
            ->get('/movie/popular?api_key='.config('tmdb.key').
                '&language='.config('tmdb.language').
                '&page='.$page)
            ->json();
    }

    /**
     * @param string $movieId
     * @return array
     */
    public function getMovieInformation(string $movieId) : array
    {
        return Http::themoviedatabase()
            ->get('/movie/'.$movieId.'?api_key='.config('tmdb.key').
                '&language='.config('tmdb.language'))
            ->json();
    }

    /**
     * @param string $movieId
     * @return mixed
     */
    public function getMovieVideos(string $movieId) : array
    {
        return Http::themoviedatabase()
            ->get('/movie/'.$movieId.'/videos?api_key='.config('tmdb.key').
                '&language='.config('tmdb.language'))
            ->json();
    }
}
