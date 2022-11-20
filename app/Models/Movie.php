<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * @return HasMany
     */
    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
