<?php

namespace Database\Seeders;

use App\Jobs\SaveMovieExtraInformationJob;
use App\Jobs\SaveMovieVideosJob;
use App\Jobs\UploadTMDBImageJob;
use App\Models\Movie;
use App\Services\TheMovieDBService;
use App\Utility\BackdropFilename;
use App\Utility\PosterFilename;
use Illuminate\Database\Seeder;

class PopularMoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $theMovieDBService = new TheMovieDBService();

        $popularMovies = [];

        for ($page = 1; $page <= 3; $page++)
        {
            $getMovies = $theMovieDBService->getPopularMovies($page);
            $popularMovies = array_merge($popularMovies, $getMovies['results']);
        }

        $popularMovies = collect($popularMovies)->unique();

        foreach ($popularMovies as $popularMovie) {
            $posterFilename = new PosterFilename();
            $posterFilename->setFilename($popularMovie['original_title']);
            UploadTMDBImageJob::dispatch($posterFilename, $popularMovie['poster_path']);

            $backdropFilename = new BackdropFilename();
            $backdropFilename->setFilename($popularMovie['original_title']);
            UploadTMDBImageJob::dispatch($backdropFilename, $popularMovie['backdrop_path']);

            $movie = Movie::create([
                'title'          => $popularMovie['title'],
                'original_title' => $popularMovie['original_title'],
                'poster_path'    => $posterFilename->filename,
                'backdrop_path'  => $backdropFilename->filename,
                'overview'       => $popularMovie['overview'],
                'release_date'   => $popularMovie['release_date'],
                'source'         => "TheMovieDatabase",
                'source_id'      => $popularMovie['id']
            ]);

            SaveMovieExtraInformationJob::withChain([
                new SaveMovieVideosJob($movie, $popularMovie['id'])
            ])->dispatch($movie, $popularMovie['id']);
        }
    }
}
