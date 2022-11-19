<?php

use App\Models\Movie;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $movies = Movie::get()->toArray();

    return view('test', compact('movies'));
});
