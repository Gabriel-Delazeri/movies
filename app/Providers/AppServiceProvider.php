<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Http::macro('themoviedatabase', function() {
            return Http::acceptJson()
                ->baseUrl(config('tmdb.url'))
                ->retry(3, 100);
        });

        Http::macro('themoviedatabaseimages', function() {
           return Http::acceptJson()
               ->baseUrl('https://image.tmdb.org/t/p/original')
               ->retry(3,100);
        });
    }
}
