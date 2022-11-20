<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class MovieController extends Controller
{

    /**
     * Return Movie Index
     *
     * @return Renderable
     */
    public function index()
    {
        $movies = Movie::get()->toArray();

        return view('movies.index', compact('movies'));
    }

    /**
     * Return Movie Videos Page
     *
     * @param Movie $movie
     * @return Renderable
     */
    public function videos(Movie $movie)
    {
        $movieVideos = $movie->videos->toArray();

        return view('movies.video', compact('movieVideos'));
    }
}
