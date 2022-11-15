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

class SaveMovieExtraInformationJob implements ShouldQueue
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

        $movieExtraInformation = $theMovieDBService->getMovieInformation($this->movieId);

        $this->movie->update([
            'runtime' => $movieExtraInformation['runtime']
        ]);
    }
}
