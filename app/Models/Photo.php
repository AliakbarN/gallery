<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Photo extends Model implements Searchable
{
    use HasFactory;

    protected $fillable = [
        'original_name',
        'translated_name',
        'path',
    ];

    public function getSearchResult(): SearchResult
    {
        $url = route('photos.index');

        return new SearchResult(
            $this,
            'photo',
            $url
        );
    }
}
