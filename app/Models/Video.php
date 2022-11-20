<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'language',
        'title',
        'key',
        'site',
        'type',
        'movie_id',
        'source',
        'source_id',
    ];

    /**
     * @return BelongsTo
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
