<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'original_title',
        'poster_path',
        'backdrop_path',
        'overview',
        'release_date',
        'source',
        'source_id',
        'runtime'
    ];
}
