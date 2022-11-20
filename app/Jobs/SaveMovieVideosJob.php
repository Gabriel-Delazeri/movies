<?php

namespace App\Jobs;

use App\Models\Movie;
use App\Services\TheMovieDBService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveMovieVideosJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        protected Movie $movie,
        protected string $movieId,
    )
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $theMovieDBService = new TheMovieDBService();

        $thisMovieVideos = $theMovieDBService->getMovieVideos($this->movieId);

        foreach ($thisMovieVideos['results'] as $video) {
            $this->movie->videos()->create([
                'language' => $video['iso_639_1'] . '-' . $video['iso_3166_1'],
                'title' => $video['name'],
                'key' => $video['key'],
                'site' => $video['site'],
                'type' => $video['type'],
                'movie_id' => $this->movie->id,
                'source' => 'TheMovieDatabase',
                'source_id' => $video['id'],
            ]);
        }
    }
}
